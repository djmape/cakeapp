<?php
namespace App\Controller\Forums;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Mailer\Email;
use App\Form\EmailForm;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ForumTopicsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->checkLoginStatus();
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function forumTopicsIndex($category_name)
    {   
        $this->header();
        $this->title('PUPQC Forum | Topics');

        $this->loadModel('Posts');
        $this->loadModel('Announcements');
        $this->loadModel('Users');
        $this->loadModel('UserProfiles');

        $this->loadModel('ForumCategories');
        $this->loadModel('ForumCategoryDetails');
        $forumCategories = $this->paginate($this->ForumCategories->find('all')->contain('ForumCategoryDetails')->where(['ForumCategories.forum_category_active' => 1]));
        $this->set(compact('forumCategories'));
    }

    public function forumTopicsAll($forum_category_name)
    {   
        $this->header();
        $this->title('Forum | ' . str_replace('-', ' ', $forum_category_name) . ' Topics');

        $this->loadModel('ForumCategories');
        $this->loadModel('ForumCategoryDetails');
        $this->loadModel('ForumTopics');
        $this->loadModel('ForumTopicDetails');

        $forumCategory = $this->ForumCategories->find('all')->where(['ForumCategories.forum_category_name' => str_replace('-', ' ', $forum_category_name)])->first();
        $this->set('forumCategory', $forumCategory);
        $this->log($forumCategory,'debug');

        $forumTopics = $this->paginate($this->ForumTopics->find('all')->contain(['ForumCategories.ForumCategoryDetails','ForumTopicDetails','Users'])->where(['ForumTopics.forum_topic_active' => 1,'ForumCategories.forum_category_name' => str_replace('-', ' ', $forum_category_name)]));
        $this->log($forumTopics->first(),'debug');
        $this->set(compact('forumTopics'));
    }

    public function addForumTopic()
    {   

        $this->layout = false;
        $this->autoRender = false;

        
        $this->header();
        $this->title('PUPQC Forum | Topics');

        $this->loadModel('UserActivities');
        $this->loadModel('ForumActivities');
        $this->loadModel('ForumTopics');
        $this->loadModel('ForumTopicActivities');
        $this->loadModel('ForumTopicDetails');
        $this->loadModel('ForumCategoryDetails');
        $this->loadModel('UserForumActivityCounts');
        $this->loadModel('ForumTopicHistory');

        $currentUser = $this->Auth->user('id');

        $userActivity = $this->UserActivities->newEntity();
        $forumActivity = $this->ForumActivities->newEntity();
        $forumTopic= $this->ForumTopics->newEntity();
        $forumTopicActivity = $this->ForumTopicActivities->newEntity();
        $forumTopicDetail = $this->ForumTopicDetails->newEntity();
        $forumUserActivityCount = $this->UserForumActivityCounts->newEntity();
        $forumTopicHistory = $this->UserActivities->newEntity();   

        # begin post/put
        if ($this->request->is(['post','put'])) {

            # begin save to UserActivities

            $userActivity->user_activity_activity_type_id = 2;
            $userActivity->user_activity_user_id = $currentUser;

            if ($activityID = $this->UserActivities->save($userActivity)) {

                # begin save to ForumActivities

                $forumActivity->forum_activity_type_id = 2;
                $forumActivity->forum_activity_user_id = $currentUser;
                $forumActivity->forum_activity_activity_id = $activityID->user_activity_id;

                if ($forumActivityID = $this->ForumActivities->save($forumActivity)) {

                    # begin save to ForumTopics

                    $forum_topic_name = $this->request->data['forum_topic_name'];
                    $forum_category_id = $this->request->data['forum_category_id'];

                    $forumTopic->forum_topic_name = $forum_topic_name;
                    $forumTopic->forum_topic_created_by_user_id = $currentUser;
                    $forumTopic->forum_topic_category_id = $forum_category_id;

                    if ($forumTopicID = $this->ForumTopics->save($forumTopic)) {

                        # begin save to ForumTopicActivities

                        $forumTopicActivity->forum_topic_activity_forum_activity_id = $forumActivityID->forum_activity_id;
                        $forumTopicActivity->forum_topic_activity_forum_topic_id = $forumTopicID->forum_topic_id;

                        if ($forumTopicActivityID = $this->ForumTopicActivities->save($forumTopicActivity)) {

                            # begin save to ForumTopicDetails

                            $forumTopicDetail->forum_topic_detail_topic_id = $forumTopicID->forum_topic_id;

                            if ($forumTopicDetailID = $this->ForumTopicDetails->save($forumTopicDetail)) {

                                # begin save to ForumCategoryDetails
                                $getForumCategoryDetailID = $this->ForumCategoryDetails->find('all')->where(['ForumCategoryDetails.forum_category_detail_category_id' => $forum_category_id])->first()->forum_category_detail_id;
                                    
                                $forumCategoryDetailsTable = TableRegistry::get('ForumCategoryDetails');

                                $forumCategoryDetailsTable = TableRegistry::getTableLocator()->get('ForumCategoryDetails');
                                $forumCategoryDetail = $forumCategoryDetailsTable->get($getForumCategoryDetailID);

                                $forumCategoryDetail->forum_category_topics_count += 1;


                                if ($forumCategoryDetailsTable->save($forumCategoryDetail)) {
                                    
                                    # begin save UserForumActivityCounts 

                                    $checkIfUserHasEntry = $this->UserForumActivityCounts->find('all')->where(['UserForumActivityCounts.user_id' => $currentUser]);

                                    if ($checkIfUserHasEntry->isEmpty()) {

                                        $forumUserActivityCount->user_id = $currentUser;
                                        $forumUserActivityCount->user_forum_activity_topics_count = 1;

                                        if ($this->UserForumActivityCounts->save($forumUserActivityCount)) {

                                            # begin save ForumTopicHistory 

                                            $forumTopicHistory->forum_topic_history_topic_name = $forum_topic_name;
                                            $forumTopicHistory->forum_topic_id = $forumTopicID->forum_topic_id;

                                            if ($this->ForumTopicHistory->save($forumTopicHistory)) {
                                                $this->Flash->success('Topic Added!', [
                                                    'params' => [
                                                        'saves' => 'Topic Added!'
                                                    ]
                                                ]);
                                                return $this->redirect(['controller' => 'ForumCategories','action' => 'forumTopicsIndex', $forum_category_id]);
                                            }
                                            else {
                                                $this->log($forumTopicHistory->errors(),'debug');
                                            }
                                            # end save ForumTopicHistory
                                        }
                                        else {
                                            $this->log($forumUserActivityCount->errors(),'debug');
                                        }
                                    }
                                    else {

                                        $getUserForumActivityCountID = $this->UserForumActivityCounts->find('all')->where(['UserForumActivityCounts.user_id' => $currentUser])->first()->user_forum_activity_count_id;

                                        $forumActivityCountsTable = TableRegistry::get('UserForumActivityCounts');

                                        $forumActivityCountsTable = TableRegistry::getTableLocator()->get('UserForumActivityCounts');
                                        $forumActivityCount = $forumActivityCountsTable->get($getUserForumActivityCountID);

                                        $forumActivityCount->user_forum_activity_topics_count += 1;

                                        if ($forumActivityCountsTable->save($forumActivityCount)) {

                                            # begin save ForumTopicHistory 

                                            $forumTopicHistory->forum_topic_history_topic_name = $forum_topic_name;
                                            $forumTopicHistory->forum_topic_id = $forumTopicID->forum_topic_id;

                                            if ($this->ForumTopicHistory->save($forumTopicHistory)) {
                                                $this->Flash->success('Topic Added!', [
                                                    'params' => [
                                                        'saves' => 'Topic Added!'
                                                    ]
                                                ]);
                                                return $this->redirect(['controller' => 'ForumCategories','action' => 'forumTopicsIndex', $forum_category_id]);
                                            }
                                            else {
                                                $this->log($forumTopicHistory->errors(),'debug');
                                             }
                                            # end save ForumTopicHistory
                                        }
                                        else {
                                            $this->log($forumActivityCount->errors(),'debug');
                                        }
                                    }
                                }
                                # end save to ForumCategoryDetails
                            }
                            # end save to ForumTopicDetails
                        }
                        # end save to ForumTopicActivities
                    }
                    # end save to ForumTopics
                }
                # end save to ForumActivities
            }
            # end save to UserActivities
        }
        # end post/put
    }

    public function forumEditTopic()
    {   
        $this->layout = false;
        $this->autoRender = false;

        $this->loadModel('UserActivities');
        $this->loadModel('ForumActivities');
        $this->loadModel('ForumTopics');
        $this->loadModel('ForumTopicHistory');

        $userActivity = $this->UserActivities->newEntity();
        $forumActivity = $this->ForumActivities->newEntity();
        $forumTopicHistory = $this->ForumTopicHistory->newEntity();   

        $currentUser = $this->Auth->user('id');

        if ($this->request->is(['post', 'put'])) {

            # begin save UserActivities

            $userActivity->user_activity_activity_type_id = 2; # forum
            $userActivity->user_activity_user_id = $currentUser;

            if ($activityID = $this->UserActivities->save($userActivity)) {

                # begin save ForumActivities 

                $forumActivity->forum_activity_type_id = 7; # edit topic
                $forumActivity->forum_activity_user_id = $currentUser;
                $forumActivity->forum_activity_activity_id = $activityID->user_activity_id;

                if ($forumID = $this->ForumActivities->save($forumActivity)) {

                    # begin update ForumTopics
                    $topic_id = $this->request->data['topic_id'];
                    $forumTopicTable = TableRegistry::get('ForumTopics');
                    $forumTopicTable = TableRegistry::getTableLocator()->get('ForumTopics');
                    $forumTopic = $forumTopicTable->get($topic_id);

                    $forumTopic->forum_topic_modified = date("Y-m-d H:i:s");
                    $forumTopic->forum_topic_name = $this->request->data['topic'];

                    if ($forumTopicTable->save($forumTopic)) {

                        # begin save ForumTopicHistory 

                        $forumTopicHistory->forum_topic_history_topic_name = $this->request->data['topic'];
                        $forumTopicHistory->forum_topic_id = $topic_id;

                        if ($this->ForumTopicHistory->save($forumTopicHistory)) {
                            return $this->redirect(['controller' => 'ForumCategories','action' => 'forumTopicsIndex', $this->request->data['forum_category_name']]);
                        }
                        else {
                            $this->log($forumTopicHistory->errors(),'debug');
                        }
                        # end save ForumTopicHistory 
                    }
                    else {
                        $this->log($forumTopic->errors(),'debug');
                    }
                    # end update ForumTopics
                }
                else {
                    $this->log($forumActivity->errors(),'debug');
                }
                # end save ForumActivities
            }
            else {
                $this->log($userActivity->errors(),'debug');
            }
            # end save UserActivities
        }
    }

    public function forumDeleteTopic()
    {   
        $this->layout = false;
        $this->autoRender = false;

        $this->loadModel('UserActivities');
        $this->loadModel('ForumActivities');
        $this->loadModel('ForumCategories');
        $this->loadModel('ForumCategoryDetails');
        $this->loadModel('ForumTopics');
        $this->loadModel('UserForumActivityCounts');

        $userActivity = $this->UserActivities->newEntity();
        $forumActivity = $this->ForumActivities->newEntity();

        $currentUser = $this->Auth->user('id');
        $forum_topic_id = $this->request->data['forum_topic_id'];
        $forum_category_name = $this->request->data['forum_category_name'];

        # begin post put

        if ($this->request->is(['post', 'put'])) {

            # begin save UserActivities

            $userActivity->user_activity_activity_type_id = 2;  # forum
            $userActivity->user_activity_user_id = $currentUser;

            if ($activityID = $this->UserActivities->save($userActivity)) {

                # begin save ForumActivities 

                $forumActivity->forum_activity_type_id = 11; # delete topic
                $forumActivity->forum_activity_user_id = $currentUser;
                $forumActivity->forum_activity_activity_id = $activityID->user_activity_id;

                if ($forumID = $this->ForumActivities->save($forumActivity)) {

                    # begin update ForumReplies

                    $forumTopicTable = TableRegistry::get('ForumTopics');
                    $forumTopicTable = TableRegistry::getTableLocator()->get('ForumTopics');
                    $forumTopic = $forumTopicTable->get($forum_topic_id);

                    $forumTopic->forum_topic_modified = date("Y-m-d H:i:s");
                    $forumTopic->forum_topic_active = 0;

                    if ($forumTopicTable->save($forumTopic)) {

                        # begin update ForumCategoryDetails 

                        $getCategoryID = $this->ForumCategories->find('all')->where(['ForumCategories.forum_category_name' => str_replace('-', ' ', $forum_category_name)])->first()->forum_category_id;

                        $getForumCategoryDetailID = $this->ForumCategoryDetails->find('all')->where(['ForumCategoryDetails.forum_category_detail_category_id' => $getCategoryID])->first()->forum_category_detail_id;
                                    
                        $forumCategoryDetailsTable = TableRegistry::get('ForumCategoryDetails');

                        $forumCategoryDetailsTable = TableRegistry::getTableLocator()->get('ForumCategoryDetails');
                        $forumCategoryDetail = $forumCategoryDetailsTable->get($getForumCategoryDetailID);

                        $forumCategoryDetail->forum_category_topics_count -= 1;

                        if ($forumCategoryDetailsTable->save($forumCategoryDetail)) {

                            # begin update UserForumActivityCounts

                            $getUserForumActivityCountID = $this->UserForumActivityCounts->find('all')->where(['UserForumActivityCounts.user_id' => $currentUser])->first()->user_forum_activity_count_id;

                            $forumActivityCountsTable = TableRegistry::get('UserForumActivityCounts');

                            $forumActivityCountsTable = TableRegistry::getTableLocator()->get('UserForumActivityCounts');
                            $forumActivityCount = $forumActivityCountsTable->get($getUserForumActivityCountID);

                            $forumActivityCount->user_forum_activity_topics_count -= 1;

                            if ($forumActivityCountsTable->save($forumActivityCount)) {

                                # delete complete

                            }
                            else {
                                $this->log($forumActivityCount->errors(),'debug');
                            }
                            # end update UserForumActivityCounts
                        }
                        else {
                            $this->log($forumCategoryDetail->errors(),'debug');
                        }
                        # end update ForumCategoryDetails
                    }
                    else {
                        $this->log($forumTopic->errors(),'debug');
                    }
                    # end update ForumReplies
                }
                else {
                    $this->log($forumActivity->errors(),'debug');
                }
                # end save ForumActivities 
            }
            else {
                $this->log($userActivity->errors(),'debug');
            }
            # end save UserActivities
        }
    }

    public function forumReplies()
    {   
        $this->header();
        $this->title('PUPQC | Forum Discussions');

        $this->loadModel('Posts');
        $this->loadModel('Announcements');
        $this->loadModel('Users');
        $this->loadModel('UserProfiles');

        $paginate = ['sortWhitelist' => 'Posts.post_modified'];
        $posts = $this->paginate($this->Posts->find('all')->contain(['Users.UserProfiles','Announcements'])->where(['Posts.post_active' => 1]));
        $this->log($posts->first(),'debug');
        $this->set(compact('posts'));
    }

    public function changePassword() {
        $this->adminProfileSideBar('password');

        $user = $this->Users->find('all')->where(['Users.id'=>$this->Auth->user('id')]);
        $this->set('user',$user);
        $row = $user->first();

        if ($this->request->is(['post', 'put'])) {

            $usersTable = TableRegistry::get('Users');

            $usersTable = TableRegistry::getTableLocator()->get('Users');
            $users = $usersTable->get($this->Auth->user('id'));

            $current_password = $this->request->data['current_password'];

            if ((new DefaultPasswordHasher)->check($current_password, $users->password)) {

                $users->password = $this->request->data['new_password'];

                 if ($usersTable->save($users)) {
                    $this->Flash->success('User Updated!', [
                    'params' => [
                        'saves' => 'Password Updated!'
                        ]
                    ]);
                return $this->redirect(['action' => 'changePassword', $this->Auth->user('id')]);
                }
                else {
                debug($event->errors());
                $this->Flash->error(__('Unable to add your article.'));
                }
            }
            else {
                    $this->Flash->error('incorrect Password', [
                    'params' => [
                        'saves' => 'incorrect Password!'
                        ]
                    ]);
            }
      }      
        $this->set('user',$user);
    }


    public function isAuthorized($user) {

    if (in_array($this->request->action, ['forumTopicsIndex', 'addForumTopic','forumTopicsAll','forumEditTopic','forumDeleteTopic','register','adminAll','adminAdd','adminEdit','adminDelete','employeesAll','employeeAdd','employeeEdit','studentsAll','studentAdd','studentEdit','alumniAll','alumniAdd','alumniEdit','deleteUser','logout'])) {
        return true;
    }

        return parent::isAuthorized($user);
    }
}
