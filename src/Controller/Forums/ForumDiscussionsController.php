<?php
namespace App\Controller\Forums;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Mailer\Email;
use App\Form\EmailForm;
use Cake\ORM\Query;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ForumDiscussionsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->adminSideBarHasSub('users');
        $this->navBar('');
        $currentUser = $this->Auth->user('id');
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function forumDiscussionsIndex($forum_category_name,$forum_topic_name)
    {   
        $this->header();
        $this->title('PUPQC Forum | Discussions');

        $this->loadModel('ForumCategories');
        $this->loadModel('ForumTopics');

        $forumTopic = $this->ForumTopics->find('all')->contain(['ForumCategories'])->where(['ForumTopics.forum_topic_name' => str_replace('-', ' ', $forum_topic_name)])->first();

        $forum_topic_id = $forumTopic->forum_topic_id;

        $this->loadModel('ForumDiscussions');
        $forumDiscussions = $this->paginate($this->ForumDiscussions->find('all')->contain(['ForumDiscussionDetails','ForumTopics.ForumCategories','Users'])->where(['ForumTopics.forum_topic_id' => $forum_topic_id]));

        $this->log($forumDiscussions,'debug');
        $this->set('forumDiscussions', $forumDiscussions);
        $this->set(compact('forumDiscussions'));
        $this->set('forumTopic', $forumTopic);
    }

    public function forumAddDiscussion($forum_category_name,$forum_topic_name)
    {   
        $this->header();
        $this->title('Forum | Add ' . str_replace('-', ' ', $forum_topic_name) . ' Discussion');

        # load models
        $this->loadModel('UserActivities');
        $this->loadModel('ForumActivities');
        $this->loadModel('ForumCategories');
        $this->loadModel('ForumTopics');
        $this->loadModel('ForumDiscussions');
        $this->loadModel('ForumDiscussionActivities');
        $this->loadModel('ForumDiscussionDetails');
        $this->loadModel('ForumCategoryDetails');
        $this->loadModel('ForumTopicDetails');
        $this->loadModel('UserForumActivityCounts');

        $currentUser = $this->Auth->user('id');

        $userActivity = $this->UserActivities->newEntity();
        $forumActivity = $this->ForumActivities->newEntity();
        $forumDiscussion = $this->ForumDiscussions->ForumDiscussionDetails->newEntity();
        $forumDiscussionActivity = $this->ForumDiscussionActivities->newEntity();
        $forumDiscussionDetail = $this->ForumDiscussionDetails->newEntity();

        $forumTopic = $this->ForumTopics->find('all')->contain(['ForumCategories'])->where(['ForumTopics.forum_topic_name' => str_replace('-', ' ', $forum_topic_name)])->first();

        $forum_topic_id = $forumTopic->forum_topic_id;

        $this->loadModel('ForumDiscussions.ForumDiscussionDetails');
        $forumDiscussions = $this->paginate($this->ForumDiscussions->find('all')->contain(['ForumDiscussionDetails','ForumTopics.ForumCategories'])->where(['ForumTopics.forum_topic_id' => $forum_topic_id]));

        # begin post/put
        if ($this->request->is(['post','put'])) { 

            # begin save to UserActivities

            $userActivity->user_activity_activity_type_id = 2;
            $userActivity->user_activity_user_id = $currentUser;

            if ($activityID = $this->UserActivities->save($userActivity)) {

                # begin save to ForumActivities

                $forumActivity->forum_activity_type_id = 3;
                $forumActivity->forum_activity_user_id = $currentUser;
                $forumActivity->forum_activity_activity_id = $activityID->user_activity_id;

                if ($forumActivityID = $this->ForumActivities->save($forumActivity)) {

                    # begin save to ForumDiscussions 

                    $forum_discussion_topic_id = $this->ForumTopics->find('all')->where(['ForumTopics.forum_topic_name' => str_replace('-', ' ', $forum_topic_name)])->first()->forum_topic_id;

                    $forumDiscussion->forum_discussion_title = $this->request->data['forum_discussion_title'];
                    $forumDiscussion->forum_discussion_created_by_user_id = $currentUser;
                    $forumDiscussion->forum_discussion_topic_id = $forum_discussion_topic_id;

                    if ($forumDiscussionID = $this->ForumDiscussions->save($forumDiscussion)) {
                        
                        # begin save ForumDiscussionActivities

                        $forumDiscussionActivity->forum_discussion_activity_forum_activity_id = $forumActivityID->forum_activity_id;
                        $forumDiscussionActivity->forum_discussion_activity_forum_discussion_id = $forumDiscussionID->forum_discussion_id;

                        if ($forumDiscussionActivityID = $this->ForumDiscussionActivities->save($forumDiscussionActivity)) {

                            # begin save ForumDiscussionDetails

                            $forumDiscussionDetail->forum_discussion_detail_discussion_id = $forumDiscussionID->forum_discussion_id;
                            $forumDiscussionDetail->forum_discussion_content = $this->request->data['forum_discussion_content'];

                            if ($forumDiscussionDetailID = $this->ForumDiscussionDetails->save($forumDiscussionDetail)) {

                                # begin save ForumCategoryDetails 
                                $getCategoryID = $this->ForumCategories->find('all')->where(['ForumCategories.forum_category_name' => str_replace('-', ' ', $forum_category_name)])->first()->forum_category_id;

                                $getForumCategoryDetailID = $this->ForumCategoryDetails->find('all')->where(['ForumCategoryDetails.forum_category_detail_category_id' => $getCategoryID])->first()->forum_category_detail_id;
                                    
                                $forumCategoryDetailsTable = TableRegistry::get('ForumCategoryDetails');

                                $forumCategoryDetailsTable = TableRegistry::getTableLocator()->get('ForumCategoryDetails');
                                $forumCategoryDetail = $forumCategoryDetailsTable->get($getForumCategoryDetailID);

                                $forumCategoryDetail->forum_category_discussions_count += 1;


                                if ($forumCategoryDetailsTable->save($forumCategoryDetail)) {

                                    # begin save ForumTopicDetails

                                    $getForumTopicID = $this->ForumTopics->find('all')->where(['ForumTopics.forum_topic_name' => str_replace('-', ' ',$forum_topic_name)])->first()->forum_topic_id;

                                    $getForumTopicDetailID = $this->ForumTopicDetails->find('all')->where(['ForumTopicDetails.forum_topic_detail_topic_id' => $getForumTopicID])->first()->forum_topic_detail_id;
                                    
                                    $forumTopicDetailsTable = TableRegistry::get('ForumTopicDetails');

                                    $forumTopicDetailsTable = TableRegistry::getTableLocator()->get('ForumTopicDetails');
                                    $forumTopicDetail = $forumTopicDetailsTable->get($getForumTopicDetailID);

                                    $forumTopicDetail->forum_topic_detail_discussions_count += 1;

                                    if ($forumTopicDetailsTable->save($forumTopicDetail)) {

                                        # begin save UserForumActivityCounts
                                        $checkIfUserHasEntry = $this->UserForumActivityCounts->find('all')->where(['UserForumActivityCounts.user_id' => $currentUser]);


                                        if ($checkIfUserHasEntry->isEmpty()) {

                                            $forumUserActivityCount = $this->UserForumActivityCounts->newEntity();
                                            $forumUserActivityCount->user_id = $currentUser;
                                            $forumUserActivityCount->user_forum_activity_discussions_count = 1;

                                            if ($this->UserForumActivityCounts->save($forumUserActivityCount)) {

                                                $this->Flash->success('Reply Added!', [
                                                    'params' => [
                                                        'saves' => 'Reply Added!'
                                                    ]
                                                ]);
                                                return $this->redirect(['controller' => 'ForumDiscussions','action' => 'forumReplies', $forum_category_name, $forum_topic_name,$this->request->data['forum_discussion_title']]);

                                            }
                                            else {
                                            }
                                        }

                                        else {

                                                $getUserForumActivityCountID = $this->UserForumActivityCounts->find('all')->where(['UserForumActivityCounts.user_id' => $currentUser])->first()->user_forum_activity_count_id;

                                                $this->log($getUserForumActivityCountID,'debug');

                                                $forumActivityCountsTable = TableRegistry::get('UserForumActivityCounts');

                                                $forumActivityCountsTable = TableRegistry::getTableLocator()->get('UserForumActivityCounts');
                                                $forumActivityCount = $forumActivityCountsTable->get($getUserForumActivityCountID);

                                                $forumActivityCount->user_forum_activity_discussions_count += 1;

                                                if ($forumActivityCountsTable->save($forumActivityCount)) {

                                                    $this->Flash->success('Discussion Added!', [
                                                        'params' => [
                                                            'saves' => 'Discussion Added!'
                                                        ]
                                                    ]);
                                                    return $this->redirect(['controller' => 'ForumDiscussions','action' => 'forumDiscussionsIndex', $forum_category_name, $forum_topic_name, ]);
                                                }
                                                else {

                                                }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        # set
        $this->set('forumDiscussions', $forumDiscussions);
        $this->set(compact('forumDiscussions'));
        $this->set('forumTopic', $forumTopic);
        $this->set('forumDiscussion',$forumDiscussion);
    }

    public function forumReplies($forum_category_name,$forum_topic_name,$forum_discussion_title)
    {   
        $this->header();
        $this->title('PUPQC Forum | ' . str_replace('-', ' ', $forum_discussion_title));

        $this->loadModel('ForumDiscussions');
        $this->loadModel('Announcements');
        $this->loadModel('Users');
        $this->loadModel('UserProfiles');
        $this->loadModel('ForumReplies');

        $discussion = $this->ForumDiscussions->find('all')->contain(['ForumDiscussionDetails','ForumTopics.ForumCategories','Users.UserProfiles','Users.UserTypes','Users.UserAdministrators','Users.UserEmployees.EmployeePositionNames','Users.UserStudents.Courses'=> function (Query $query) { return $query->limit(['UserStudents.user_id' => 'Users.id']);},'Users.UserAlumni.Courses','Users.UserForumActivityCounts'])->where(['ForumDiscussions.forum_discussion_title' => str_replace('-', ' ', $forum_discussion_title)])->first();
        $discussion_id = $discussion->forum_discussion_id;
        $replies = $this->paginate($this->ForumReplies->find('all')->contain(['ForumReplyDetails','Users.UserProfiles','Users.UserTypes','Users.UserAdministrators','Users.UserEmployees.EmployeePositionNames','Users.UserStudents.Courses'=> function (Query $query) { return $query->limit(['UserStudents.user_id' => 'Users.id']);},'Users.UserAlumni.Courses'=> function (Query $query) { return $query->limit(['UserAlumni.user_id' => 'Users.id']);},'Users.UserForumActivityCounts'])->where(['ForumReplies.forum_discussion_id' => $discussion_id]));
        $this->set('discussion',$discussion);
        $this->log($discussion,'debug');
        $this->set('replies',$replies);
        $this->set(compact('replies'));
        $this->log($replies,'debug');
    }

    public function forumAddReply($forum_category_name,$forum_topic_name,$forum_discussion_title) 
    {
        
        $this->loadModel('ForumCategories');
        $this->loadModel('ForumTopics');
        $this->loadModel('ForumDiscussions');
        $this->loadModel('ForumReplies');
        $this->loadModel('UserActivities');
        $this->loadModel('ForumActivities');
        $this->loadModel('ForumReplyActivities');
        $this->loadModel('ForumReplyDetails');
        $this->loadModel('ForumCategoryDetails');
        $this->loadModel('ForumTopicDetails');
        $this->loadModel('ForumDiscussionDetails');
        $this->loadModel('UserForumActivityCounts');

        $currentUser = $this->Auth->user('id');

        $userActivity = $this->UserActivities->newEntity();
        $forumActivity = $this->ForumActivities->newEntity();
        $forumReply = $this->ForumReplies->newEntity();
        $forumReplyActivity = $this->ForumReplyActivities->newEntity();
        $forumReplyDetail = $this->ForumReplyDetails->newEntity();
        $this->set('forumReplyDetail',$forumReplyDetail);
        $forumCategoryDetail = $this->ForumCategoryDetails->newEntity();
        $forumTopicDetail = $this->ForumTopicDetails->newEntity();
        $forumDiscussionDetail = $this->ForumDiscussionDetails->newEntity();
        $forumUserActivityCount = $this->UserForumActivityCounts->newEntity();

        $discussion = $this->ForumDiscussions->find('all')->contain(['ForumDiscussionDetails','ForumTopics.ForumCategories','Users.UserProfiles','Users.UserTypes','Users.UserAdministrators','Users.UserEmployees.EmployeePositionNames','Users.UserStudents.Courses','Users.UserAlumni.Courses','Users.UserForumActivityCounts'])->where(['ForumDiscussions.forum_discussion_title' => str_replace('-', ' ', $forum_discussion_title)])->first();
        $this->log($discussion,'debug');
        $this->set('discussion',$discussion);

        if ($this->request->is(['post', 'put'])) {

            # begin save UserActivities

            $userActivity->user_activity_activity_type_id = 2;
            $userActivity->user_activity_user_id = $currentUser;

            if ($activityID = $this->UserActivities->save($userActivity)) {

                # begin save ForumActivities 

                $forumActivity->forum_activity_type_id = 4;
                $forumActivity->forum_activity_user_id = $currentUser;
                $forumActivity->forum_activity_activity_id = $activityID->user_activity_id;

                if ($forumID = $this->ForumActivities->save($forumActivity)) {

                    # begin save ForumReplies

                    $forumReply->forum_reply_created_by_user_id = $currentUser;
                    $forumReply->forum_discussion_id = $discussion->forum_discussion_id;

                    if ($replyID = $this->ForumReplies->save($forumReply)) {

                        # begin save ForumReplyActivities

                        $forumReplyActivity->forum_reply_activity_forum_activity_id = $forumID->forum_activity_id;
                        $forumReplyActivity->forum_reply_activity_forum_reply_id = $replyID->forum_reply_id;
                        $this->log($forumReplyActivity->forum_reply_activity_forum_reply_id,'debug');

                        if ($replyActivityID = $this->ForumReplyActivities->save($forumReplyActivity)) {

                            # begin save ForumReplyDetails

                            $forumReplyDetail->forum_reply_detail_content = $this->request->data['forum_reply_detail_content'];
                            $forumReplyDetail->forum_reply_detail_forum_reply_id = $replyID->forum_reply_id;

                            if ($replyDetailID = $this->ForumReplyDetails->save($forumReplyDetail)) {

                                # begin save ForumCategoryDetails 
                                $getCategoryID = $this->ForumCategories->find('all')->where(['ForumCategories.forum_category_name' => str_replace('-', ' ', $forum_category_name)])->first()->forum_category_id;

                                $getForumCategoryDetailID = $this->ForumCategoryDetails->find('all')->where(['ForumCategoryDetails.forum_category_detail_category_id' => $getCategoryID])->first()->forum_category_detail_id;
                                    
                                $forumCategoryDetailsTable = TableRegistry::get('ForumCategoryDetails');

                                $forumCategoryDetailsTable = TableRegistry::getTableLocator()->get('ForumCategoryDetails');
                                $forumCategoryDetail = $forumCategoryDetailsTable->get($getForumCategoryDetailID);

                                $forumCategoryDetail->forum_category_replies_count += 1;


                                if ($forumCategoryDetailsTable->save($forumCategoryDetail)) {

                                    # begin save ForumTopicDetails

                                    $getForumTopicID = $this->ForumTopics->find('all')->where(['ForumTopics.forum_topic_name' => str_replace('-', ' ',$forum_topic_name)])->first()->forum_topic_id;

                                    $getForumTopicDetailID = $this->ForumTopicDetails->find('all')->where(['ForumTopicDetails.forum_topic_detail_topic_id' => $getForumTopicID])->first()->forum_topic_detail_id;
                                    
                                    $forumTopicDetailsTable = TableRegistry::get('ForumTopicDetails');

                                    $forumTopicDetailsTable = TableRegistry::getTableLocator()->get('ForumTopicDetails');
                                    $forumTopicDetail = $forumTopicDetailsTable->get($getForumTopicDetailID);

                                    $forumTopicDetail->forum_topic_detail_replies_count += 1;

                                    if ($forumTopicDetailsTable->save($forumTopicDetail)) {
                                        
                                        # begin save ForumDiscussionDetails

                                        $getDiscussionID = $this->ForumDiscussions->find('all')->where(['ForumDiscussions.forum_discussion_title' => str_replace('-', ' ',$forum_discussion_title)])->first()->forum_discussion_id;

                                        $getDiscussionDetailID = $this->ForumDiscussionDetails->find('all')->where(['ForumDiscussionDetails.forum_discussion_detail_discussion_id' => $getDiscussionID])->first()->forum_discussion_detail_id;

                                        $discussionDetailsTable = TableRegistry::get('ForumDiscussionDetails');

                                        $discussionDetailsTable = TableRegistry::getTableLocator()->get('ForumDiscussionDetails');
                                        $discussionDetail = $discussionDetailsTable->get($getDiscussionDetailID);

                                        $discussionDetail->forum_discussion_detail_replies_count += 1;

                                        if ($discussionDetailsTable->save($discussionDetail)) {

                                            # begin save UserForumActivityCounts
                                            $checkIfUserHasEntry = $this->UserForumActivityCounts->find('all')->where(['UserForumActivityCounts.user_id' => $currentUser]);

                                            if ($checkIfUserHasEntry->isEmpty()) {

                                                $forumUserActivityCount->user_id = $currentUser;
                                                $forumUserActivityCount->user_forum_activity_replies_count = 1;

                                                if ($this->UserForumActivityCounts->save($forumUserActivityCount)) {

                                                    $this->Flash->success('Reply Added!', [
                                                        'params' => [
                                                            'saves' => 'Reply Added!'
                                                        ]
                                                    ]);
                                                return $this->redirect(['controller' => 'ForumDiscussions','action' => 'forumReplies', $forum_category_name, $forum_topic_name , $forum_discussion_title]);

                                                }

                                            }
                                            else {

                                                $getUserForumActivityCountID = $this->UserForumActivityCounts->find('all')->where(['UserForumActivityCounts.user_id' => $currentUser])->first()->user_forum_activity_count_id;

                                                $forumActivityCountsTable = TableRegistry::get('UserForumActivityCounts');

                                                $forumActivityCountsTable = TableRegistry::getTableLocator()->get('UserForumActivityCounts');
                                                $forumActivityCount = $forumActivityCountsTable->get($getUserForumActivityCountID);

                                                $forumActivityCount->user_forum_activity_replies_count += 1;

                                                if ($forumActivityCountsTable->save($forumActivityCount)) {

                                                    $this->Flash->success('Reply Added!', [
                                                        'params' => [
                                                            'saves' => 'Reply Added!'
                                                        ]
                                                    ]);
                                                    return $this->redirect(['controller' => 'ForumDiscussions','action' => 'forumReplies', $forum_category_name, $forum_topic_name , $forum_discussion_title]);

                                                }
                                                else {

                                                }


                                            }


                                        }
                                    }
                                }
                            }
                        }
                        else {
                            $this->log($forumReplyActivity->errors(),'debug');
                        }
                    }
                }

            }
        }
    }


    public function isAuthorized($user) {

    if (in_array($this->request->action, ['forumDiscussionsIndex', 'forumAddDiscussion','forumAddReply','forumDiscussions','forumReplies','register','adminAll','adminAdd','adminEdit','adminDelete','employeesAll','employeeAdd','employeeEdit','studentsAll','studentAdd','studentEdit','alumniAll','alumniAdd','alumniEdit','deleteUser','logout'])) {
        return true;
    }

        return parent::isAuthorized($user);
    }
}
