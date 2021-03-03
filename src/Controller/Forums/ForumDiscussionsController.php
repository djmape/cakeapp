<?php
namespace App\Controller\Forums;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Mailer\Email;
use App\Form\EmailForm;
use Cake\ORM\Query;
use Cake\I18n\Time;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ForumDiscussionsController extends AppController
{
	public function beforeFilter(Event $event)
    {
       // allow all action
        $this->Auth->allow(['forumDiscussionsIndex','forumReplies']);
    }

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
    public function forumDiscussionsIndex($forum_category_name,$forum_topic_name)
    {   
        $this->header();
        $this->title('PUPQC Forum | Discussions');

        $this->loadModel('ForumCategories');
        $this->loadModel('ForumTopics');

        $currentUser = $this->Auth->user('id');

        $forumTopic = $this->ForumTopics->find('all')->contain(['ForumCategories'])->where(['ForumTopics.forum_topic_name' => str_replace('-', ' ', $forum_topic_name)])->first();

        $forum_topic_id = $forumTopic->forum_topic_id;

        $this->loadModel('ForumDiscussions');
        $forumDiscussions = $this->paginate($this->ForumDiscussions->find('all')->contain(['ForumDiscussionDetails','ForumTopics.ForumCategories','Users'])->where(['ForumTopics.forum_topic_id' => $forum_topic_id,'ForumDiscussions.forum_discussion_active' => 1]));

        $this->log($forumDiscussions,'debug');
        $this->set('forumDiscussions', $forumDiscussions);
        $this->set(compact('forumDiscussions'));
        $this->set('forumTopic', $forumTopic);
        $this->set('currentUser', $currentUser);
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
        $this->loadModel('ForumDiscussionHistory');

        $currentUser = $this->Auth->user('id');

        $userActivity = $this->UserActivities->newEntity();
        $forumActivity = $this->ForumActivities->newEntity();
        $forumDiscussion = $this->ForumDiscussions->ForumDiscussionDetails->newEntity();
        $forumDiscussionActivity = $this->ForumDiscussionActivities->newEntity();
        $forumDiscussionDetail = $this->ForumDiscussionDetails->newEntity();
        $forumDiscussionHistory = $this->ForumDiscussionHistory->newEntity(); 

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

                                        # if user forum activity count for user doesn't exists
                                        if ($checkIfUserHasEntry->isEmpty()) {

                                            $forumUserActivityCount = $this->UserForumActivityCounts->newEntity();
                                            $forumUserActivityCount->user_id = $currentUser;
                                            $forumUserActivityCount->user_forum_activity_discussions_count = 1;

                                            if ($this->UserForumActivityCounts->save($forumUserActivityCount)) {

                                                # begin save ForumDiscussionHistory

                                                $forumDiscussionHistory->forum_discussion_history_discussion_title = $this->request->data['forum_discussion_title'];
                                                $forumDiscussionHistory->forum_discussion_history_discussion_content = $this->request->data['forum_discussion_content'];
                                                $forumDiscussionHistory->forum_discussion_id = $getDiscussionID;

                                                if ($this->ForumDiscussionHistory->save($forumDiscussionHistory)) {
                                                   return $this->redirect(['controller' => 'ForumDiscussions','action' => 'forumReplies', $forum_category_name, $forum_topic_name,$this->request->data['forum_discussion_title']]);
                                                }
                                                else {
                                                    $this->log($forumDiscussionHistory->errors(),'debug');
                                                }
                                                # end save ForumDiscussionHistory
                                            }
                                            else {
                                                $this->log($forumUserActivityCount->errors(),'debug');
                                            }
                                        }
                                        # end if user forum activity count for user doesn't exists

                                        # if user forum activity count for user already exists
                                        else {

                                            $getUserForumActivityCountID = $this->UserForumActivityCounts->find('all')->where(['UserForumActivityCounts.user_id' => $currentUser])->first()->user_forum_activity_count_id;

                                            $this->log($getUserForumActivityCountID,'debug');

                                            $forumActivityCountsTable = TableRegistry::get('UserForumActivityCounts');

                                            $forumActivityCountsTable = TableRegistry::getTableLocator()->get('UserForumActivityCounts');
                                            $forumActivityCount = $forumActivityCountsTable->get($getUserForumActivityCountID);

                                            $forumActivityCount->user_forum_activity_discussions_count += 1;

                                            if ($forumActivityCountsTable->save($forumActivityCount)) {

                                                # begin save ForumDiscussionHistory

                                                $forumDiscussionHistory->forum_discussion_history_discussion_title = $this->request->data['forum_discussion_title'];
                                                $forumDiscussionHistory->forum_discussion_history_discussion_content = $this->request->data['forum_discussion_content'];
                                                $forumDiscussionHistory->forum_discussion_id = $forumDiscussionID->forum_discussion_id;

                                                if ($this->ForumDiscussionHistory->save($forumDiscussionHistory)) {
                                                    return $this->redirect(['controller' => 'ForumDiscussions','action' => 'forumReplies', $forum_category_name, $forum_topic_name,$this->request->data['forum_discussion_title']]);
                                                }
                                                else {
                                                    $this->log($forumDiscussionHistory->errors(),'debug');
                                                }
                                                    # end save ForumDiscussionHistory
                                            }
                                            else {
                                                $this->log($forumActivityCount->errors(),'debug');
                                            }
                                        }
                                        # end if user forum activity count for user already exists
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

    public function forumEditDiscussion($forum_category_name,$forum_topic_name,$forum_discussion_title) 
    {

        $this->header();
        $this->title('PUPQC Forum | ' . str_replace('-', ' ', $forum_discussion_title));

        $this->loadModel('ForumDiscussions');
        $this->loadModel('ForumTopics');

        $forumTopic = $this->ForumTopics->find('all')->contain(['ForumCategories'])->where(['ForumTopics.forum_topic_name' => str_replace('-', ' ', $forum_topic_name)])->first();
        $forum_topic_id = $forumTopic->forum_topic_id;

        $forumDiscussions = $this->paginate($this->ForumDiscussions->find('all')->contain(['ForumDiscussionDetails','ForumTopics.ForumCategories'])->where(['ForumTopics.forum_topic_id' => $forum_topic_id]));

        $forum_discussion_title = str_replace('-', ' ', $forum_discussion_title);
        $forumDiscussion = $this->ForumDiscussions->find('all')->contain(['ForumDiscussionDetails'])->where(['ForumDiscussions.forum_discussion_title' => $forum_discussion_title])->first();

        # set
        $this->set('forumDiscussions', $forumDiscussions);
        $this->set(compact('forumDiscussions'));
        $this->set('forumTopic', $forumTopic);
        $this->set('forumDiscussion', $forumDiscussion);
        $this->log($forumDiscussion,'debug');

        $this->loadModel('UserActivities');
        $this->loadModel('ForumActivities');
        $this->loadModel('ForumDiscussions');
        $this->loadModel('ForumDiscussionDetails');
        $this->loadModel('ForumDiscussionHistory'); 

        $userActivity = $this->UserActivities->newEntity();
        $forumActivity = $this->ForumActivities->newEntity();
        $forumDiscussionHistory = $this->ForumDiscussionHistory->newEntity();  

        $currentUser = $this->Auth->user('id');

        if ($this->request->is(['post', 'put'])) {

            # begin save UserActivities

            $userActivity->user_activity_activity_type_id = 2; # forum
            $userActivity->user_activity_user_id = $currentUser;

            if ($activityID = $this->UserActivities->save($userActivity)) {

                # begin save ForumActivities 

                $forumActivity->forum_activity_type_id = 8; # edit discussion
                $forumActivity->forum_activity_user_id = $currentUser;
                $forumActivity->forum_activity_activity_id = $activityID->user_activity_id;

                if ($forumID = $this->ForumActivities->save($forumActivity)) {

                    # begin update ForumDiscussion

                    $getDiscussionID = $this->ForumDiscussions->find('all')->where(['ForumDiscussions.forum_discussion_title' => $forum_discussion_title])->first()->forum_discussion_id;

                    $forumDiscussionTable = TableRegistry::get('ForumDiscussions');
                    $forumDiscussionTable = TableRegistry::getTableLocator()->get('ForumDiscussions');
                    $forumDiscussion = $forumDiscussionTable->get($getDiscussionID);

                    $forumDiscussion->forum_discussion_updated = date("Y-m-d H:i:s");
                    $forumDiscussion->forum_discussion_title = $this->request->data['forum_discussion_title'];

                    if ($forumDiscussionTable->save($forumDiscussion)) {

                       # begin update ForumDiscussionDetails

                        $getDiscussionDetailID = $this->ForumDiscussionDetails->find('all')->where(['ForumDiscussionDetails.forum_discussion_detail_discussion_id' => $getDiscussionID])->first()->forum_discussion_detail_id;

                        $forumDiscussionDetailTable = TableRegistry::get('ForumDiscussionDetails');
                        $forumDiscussionDetailTable = TableRegistry::getTableLocator()->get('ForumDiscussionDetails');
                        $forumDiscussionDetail = $forumDiscussionDetailTable->get($getDiscussionDetailID);

                        $forumDiscussionDetail->forum_discussion_content = $this->request->data['forum_discussion_content'];

                        if ($forumDiscussionDetailTable->save($forumDiscussionDetail)) {

                            # begin save ForumDiscussionHistory

                            $forumDiscussionHistory->forum_discussion_history_discussion_title = $this->request->data['forum_discussion_title'];
                            $forumDiscussionHistory->forum_discussion_history_discussion_content = $this->request->data['forum_discussion_content'];
                            $forumDiscussionHistory->forum_discussion_id = $getDiscussionID;

                            if ($this->ForumDiscussionHistory->save($forumDiscussionHistory)) {
                                return $this->redirect(['controller' => 'ForumDiscussions','action' => 'forumDiscussionsIndex', $forum_category_name, $forum_topic_name, ]);
                            }
                            else {
                                $this->log($forumDiscussionHistory->errors(),'debug');
                            }
                            # end save ForumDiscussionHistory
                        }
                        else {
                            $this->log($forumDiscussionDetail->errors(),'debug');
                        }
                        # end update ForumDiscussionDetails
                    }
                    else {
                        $this->log($forumDiscussion->errors(),'debug');
                    }
                    # end update ForumDiscussion
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

    public function forumDeleteDiscussion($forum_category_name,$forum_topic_name,$forum_discussion_title) 
    {
        $this->layout = false;
        $this->autoRender = false;

        $forum_discussion_id = $this->request->data['forum_discussion_id'];

        # load models

        $this->loadModel('UserActivities');
        $this->loadModel('ForumActivities');
        $this->loadModel('ForumDiscussions');
        $this->loadModel('ForumCategories');
        $this->loadModel('ForumCategoryDetails');
        $this->loadModel('ForumTopics');
        $this->loadModel('ForumTopicDetails');
        $this->loadModel('UserForumActivityCounts');

        $userActivity = $this->UserActivities->newEntity();
        $forumActivity = $this->ForumActivities->newEntity();

        $currentUser = $this->Auth->user('id');

        # begin post put

        if ($this->request->is(['post', 'put'])) {

            # begin save UserActivities

            $userActivity->user_activity_activity_type_id = 2;  # forum
            $userActivity->user_activity_user_id = $currentUser;

            if ($activityID = $this->UserActivities->save($userActivity)) {

                # begin save ForumActivities 

                $forumActivity->forum_activity_type_id = 12; # delete discussion
                $forumActivity->forum_activity_user_id = $currentUser;
                $forumActivity->forum_activity_activity_id = $activityID->user_activity_id;

                if ($forumID = $this->ForumActivities->save($forumActivity)) {

                    # begin update ForumDiscussions

                    $forumDiscussionTable = TableRegistry::get('ForumDiscussions');
                    $forumDiscussionTable = TableRegistry::getTableLocator()->get('ForumDiscussions');
                    $forumDiscussion = $forumDiscussionTable->get($forum_discussion_id);

                    $forumDiscussion->forum_discussion_updated = date("Y-m-d H:i:s");
                    $forumDiscussion->forum_discussion_active = 0;

                    if ($forumDiscussionTable->save($forumDiscussion)) {

                        # begin update ForumCategoryDetails

                        $getCategoryID = $this->ForumCategories->find('all')->where(['ForumCategories.forum_category_name' => str_replace('-', ' ', $forum_category_name)])->first()->forum_category_id;

                        $getForumCategoryDetailID = $this->ForumCategoryDetails->find('all')->where(['ForumCategoryDetails.forum_category_detail_category_id' => $getCategoryID])->first()->forum_category_detail_id;

                        $forumCategoryDetailsTable = TableRegistry::get('ForumCategoryDetails');

                        $forumCategoryDetailsTable = TableRegistry::getTableLocator()->get('ForumCategoryDetails');
                        $forumCategoryDetail = $forumCategoryDetailsTable->get($getForumCategoryDetailID);

                        $forumCategoryDetail->forum_category_discussions_count -= 1;


                        if ($forumCategoryDetailsTable->save($forumCategoryDetail)) {

                            # begin update ForumTopicDetails

                            $getForumTopicID = $this->ForumTopics->find('all')->where(['ForumTopics.forum_topic_name' => str_replace('-', ' ',$forum_topic_name)])->first()->forum_topic_id;

                            $getForumTopicDetailID = $this->ForumTopicDetails->find('all')->where(['ForumTopicDetails.forum_topic_detail_topic_id' => $getForumTopicID])->first()->forum_topic_detail_id;

                            $forumTopicDetailsTable = TableRegistry::get('ForumTopicDetails');

                            $forumTopicDetailsTable = TableRegistry::getTableLocator()->get('ForumTopicDetails');
                            $forumTopicDetail = $forumTopicDetailsTable->get($getForumTopicDetailID);

                            $forumTopicDetail->forum_topic_detail_discussions_count -= 1;

                            if ($forumTopicDetailsTable->save($forumTopicDetail)) {

                                # begin update UserForumActivityCounts

                                $getUserForumActivityCountID = $this->UserForumActivityCounts->find('all')->where(['UserForumActivityCounts.user_id' => $currentUser])->first()->user_forum_activity_count_id;

                                $forumActivityCountsTable = TableRegistry::get('UserForumActivityCounts');

                                $forumActivityCountsTable = TableRegistry::getTableLocator()->get('UserForumActivityCounts');
                                $forumActivityCount = $forumActivityCountsTable->get($getUserForumActivityCountID);

                                $forumActivityCount->user_forum_activity_discussions_count -= 1;

                                if ($forumActivityCountsTable->save($forumActivityCount)) {

                                }
                                else {
                                    $this->log($forumActivityCount->errors(),'debug');
                                }
                                # end update UserForumActivityCounts

                            }
                            else {
                                $this->log($forumTopicDetail->errors(),'debug');
                            }
                            # end update ForumTopicDetails
                        }
                        else {
                            $this->log($forumCategoryDetail->errors(),'debug');
                        }
                        # end update ForumCategoryDetails
                    }
                    else {
                        $this->log($forumDiscussion->errors(),'debug');
                    }
                    # end update ForumDiscussions
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


    public function forumReplies($forum_category_name,$forum_topic_name,$forum_discussion_title)
    {   
        $this->header();
        $this->title('PUPQC Forum | ' . str_replace('-', ' ', $forum_discussion_title));

        $this->loadModel('ForumDiscussions');
        $this->loadModel('UserForumDiscussionVotes');
        $this->loadModel('Announcements');
        $this->loadModel('Users');
        $this->loadModel('UserProfiles');
        $this->loadModel('ForumReplies');

        $currentUser = $this->Auth->user('id');

        $discussion = $this->ForumDiscussions->find('all')->contain(['ForumDiscussionDetails','ForumTopics.ForumCategories','Users.UserProfiles','Users.UserTypes','Users.UserAdministrators','Users.UserEmployees.EmployeePositionNames','Users.UserStudents.Courses'=> function (Query $query) { return $query->limit(['UserStudents.user_id' => 'Users.id']);},'Users.UserAlumni.Courses','Users.UserForumActivityCounts'])->where(['ForumDiscussions.forum_discussion_title' => str_replace('-', ' ', $forum_discussion_title)])->first();

        if ($discussion->forum_discussion_active == 0 || $discussion == '') {
            return $this->redirect(['prefix' => 'front','controller' => 'home','action' => 'error404']);
        }
        else {

        $discussion_id = $discussion->forum_discussion_id;

        # get current user vote for discussion
        $getUserForumDiscussionVote = $this->UserForumDiscussionVotes->find('all')->where(['UserForumDiscussionVotes.forum_discussion_id' => $discussion_id,'UserForumDiscussionVotes.user_id' => $currentUser]);
        $currentDiscussionVote = '';

        if ($getUserForumDiscussionVote->count() > 0) {
            if ($getUserForumDiscussionVote->first()->forum_discussion_vote_upvote == true) {
                $currentDiscussionVote = 'DiscussionUpvote';
            }
            else if ($getUserForumDiscussionVote->first()->forum_discussion_vote_downvote == true) {
                $currentDiscussionVote = 'DiscussionDownvote';
            }
        }

        $this->set('currentDiscussionVote',$currentDiscussionVote);

        $replies = $this->paginate($this->ForumReplies->find('all')->contain([
            'ForumReplyDetails', 'ForumParentReplies.ForumReplyDetails', 'ForumParentReplies.Users.UserProfiles',
            'Users.UserProfiles','Users.UserTypes','Users.UserAdministrators',
            'Users.UserEmployees.EmployeePositionNames'=> 
                function (Query $query) { 
                    return $query->limit(['UserEmployees.user_id' => 'Users.id']);
                },
            'Users.UserStudents.Courses'=> 
                function (Query $query) { 
                    return $query->limit(['UserStudents.user_id' => 'Users.id']);
                },
            'Users.UserAlumni.Courses'=> 
                function (Query $query) { 
                    return $query->limit(['UserAlumni.user_id' => 'Users.id']);
                },
            'Users.UserForumActivityCounts',
            'UserForumReplyVotes' => 
                function (Query $query) { 
                    return $query->where(['UserForumReplyVotes.user_id' => $this->Auth->user('id') ]);
            }
            ])->leftJoinWith('ForumParentReplies')
            ->where(['ForumReplies.forum_discussion_id' => $discussion_id])
            ->order(['ForumReplies.forum_reply_created' => 'DESC'])
            );
        $this->set('discussion',$discussion);
        $this->set('replies',$replies);
        $this->set(compact('replies'));
        $this->set('currentUser',$currentUser);
        $this->log($replies,'debug');
    }
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
        $this->loadModel('ForumReplyHistory');

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
        $forumReplyHistory = $this->ForumReplyHistory->newEntity();

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

                                                    $forumReplyHistory->forum_reply_history_reply_content = $this->request->data['forum_reply_detail_content'];
                                                    $forumReplyHistory->forum_reply_id = $replyID->forum_reply_id;

                                                    if ($this->ForumReplyHistory->save($forumReplyHistory)) {

                                                        # begin save UserNotifications

                                                        $this->loadModel('UserNotifications');
                                                        $user_notification = $this->UserNotifications->newEntity();

                                                        $forum_discussion_user_id = $this->ForumDiscussions->find('all')->where(['ForumDiscussions.forum_discussion_id' => $getDiscussionID])->first()->forum_discussion_created_by_user_id;

                                                        $user_notification->user_notification_receiver_user_id = $forum_discussion_user_id;

                                                        if ($userNotification = $this->UserNotifications->save($user_notification)) {

                                                            # begin save ForumNotifications

                                                            $this->loadModel('ForumNotifications');

                                                            $forum_notification = $this->ForumNotifications->newEntity();

                                                            $forum_notification->user_notification_id = $userNotification->user_notification_id;
                                                            $forum_notification->forum_notification_sender_user_id = $currentUser;
                                                            $forum_notification->forum_notification_type_id = 1; # Discussion Reply
                                                            $forum_notification->forum_notification_discussion_id = $$getDiscussionID;

                                                            if ($this->ForumNotifications->save($forum_notification)) {

                                                                return $this->redirect(['controller' => 'ForumDiscussions','action' => 'forumReplies', $forum_category_name, $forum_topic_name , $forum_discussion_title]);
                                                            }
                                                            else {
                                                                $this->log($forum_notification->errors(),'debug');
                                                            }
                                                            # end save ForumNotifications
                                                        }
                                                        else {
                                                            $this->log($user_notification->errors(),'debug');
                                                        }
                                                        # end save UserNotifications
                                                    }
                                                }

                                            }
                                            else {

                                                $getUserForumActivityCountID = $this->UserForumActivityCounts->find('all')->where(['UserForumActivityCounts.user_id' => $currentUser])->first()->user_forum_activity_count_id;

                                                $forumActivityCountsTable = TableRegistry::get('UserForumActivityCounts');

                                                $forumActivityCountsTable = TableRegistry::getTableLocator()->get('UserForumActivityCounts');
                                                $forumActivityCount = $forumActivityCountsTable->get($getUserForumActivityCountID);

                                                $forumActivityCount->user_forum_activity_replies_count += 1;

                                                if ($forumActivityCountsTable->save($forumActivityCount)) {

                                                    $forumReplyHistory->forum_reply_history_reply_content = $this->request->data['forum_reply_detail_content'];
                                                    $forumReplyHistory->forum_reply_id = $replyID->forum_reply_id;

                                                    if ($this->ForumReplyHistory->save($forumReplyHistory)) {

                                                        # begin save UserNotifications

                                                        $this->loadModel('UserNotifications');
                                                        $user_notification = $this->UserNotifications->newEntity();

                                                        $forum_discussion_user_id = $this->ForumDiscussions->find('all')->where(['ForumDiscussions.forum_discussion_id' => $getDiscussionID])->first()->forum_discussion_created_by_user_id;

                                                        $user_notification->user_notification_receiver_user_id = $forum_discussion_user_id;

                                                        if ($userNotification = $this->UserNotifications->save($user_notification)) {

                                                            # begin save ForumNotifications

                                                            $this->loadModel('ForumNotifications');

                                                            $forum_notification = $this->ForumNotifications->newEntity();

                                                            $forum_notification->user_notification_id = $userNotification->user_notification_id;
                                                            $forum_notification->forum_notification_sender_user_id = $currentUser;
                                                            $forum_notification->forum_notification_type_id = 1; # Discussion Reply
                                                            $forum_notification->forum_notification_discussion_id = $getDiscussionID;

                                                            if ($this->ForumNotifications->save($forum_notification)) {

                                                                return $this->redirect(['controller' => 'ForumDiscussions','action' => 'forumReplies', $forum_category_name, $forum_topic_name , $forum_discussion_title]);
                                                            }
                                                            else {
                                                                $this->log($forum_notification->errors(),'debug');
                                                            }
                                                            # end save ForumNotifications
                                                        }
                                                        else {
                                                            $this->log($user_notification->errors(),'debug');
                                                        }
                                                        # end save UserNotifications
                                                    }
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

    public function forumEditReply($forum_category_name,$forum_topic_name,$forum_discussion_title,$forum_reply_id) {

        $this->header();
        $this->title('PUPQC Forum | ' . str_replace('-', ' ', $forum_discussion_title));

        $this->loadModel('ForumDiscussions');
        $this->loadModel('UserActivities');
        $this->loadModel('ForumActivities');
        $this->loadModel('ForumReplies');
        $this->loadModel('ForumReplyDetails');
        $this->loadModel('ForumReplyHistory');

        $userActivity = $this->UserActivities->newEntity();
        $forumActivity = $this->ForumActivities->newEntity();
        $forumReplyHistory = $this->ForumReplyHistory->newEntity();
        $currentUser = $this->Auth->user('id');

        $discussion = $this->ForumDiscussions->find('all')->contain(['ForumDiscussionDetails','ForumTopics.ForumCategories','Users.UserProfiles','Users.UserTypes','Users.UserAdministrators','Users.UserEmployees.EmployeePositionNames','Users.UserStudents.Courses'=> function (Query $query) { return $query->limit(['UserStudents.user_id' => 'Users.id']);},'Users.UserAlumni.Courses','Users.UserForumActivityCounts'])->where(['ForumDiscussions.forum_discussion_title' => str_replace('-', ' ', $forum_discussion_title)])->first();
        $this->set('discussion',$discussion);

        $reply = $this->ForumReplies->find('all')->contain(['ForumReplyDetails'])->where(['ForumReplies.forum_reply_id' => $forum_reply_id])->first();
        $this->set('reply',$reply);
        $this->log(date("Y-m-d H:i:s"),'debug');

        if ($this->request->is(['post', 'put'])) {

            # begin save UserActivities

            $userActivity->user_activity_activity_type_id = 2;
            $userActivity->user_activity_user_id = $currentUser;

            if ($activityID = $this->UserActivities->save($userActivity)) {

                # begin save ForumActivities 

                $forumActivity->forum_activity_type_id = 9;
                $forumActivity->forum_activity_user_id = $currentUser;
                $forumActivity->forum_activity_activity_id = $activityID->user_activity_id;

                if ($forumID = $this->ForumActivities->save($forumActivity)) {

                    # begin update ForumReplies

                    $forumReplyTable = TableRegistry::get('ForumReplies');
                    $forumReplyTable = TableRegistry::getTableLocator()->get('ForumReplies');
                    $forumReply = $forumReplyTable->get($forum_reply_id);

                    $forumReply->forum_reply_updated = date("Y-m-d H:i:s");

                    if ($forumReplyTable->save($forumReply)) {

                        $getForumReplyDetailID = $this->ForumReplyDetails->find('all')->where(['ForumReplyDetails.forum_reply_detail_forum_reply_id' => $forum_reply_id])->first()->forum_reply_detail_id;

                        $forumReplyDetailsTable = TableRegistry::get('ForumReplyDetails');
                        $forumReplyDetailsTable = TableRegistry::getTableLocator()->get('ForumReplyDetails');
                        $forumReplyDetails = $forumReplyDetailsTable->get($getForumReplyDetailID);

                        $forumReplyDetails->forum_reply_detail_content = $this->request->data['forum_reply_detail_content'];

                        if ($forumReplyDetailsTable->save($forumReplyDetails)) {

                            $forumReplyHistory->forum_reply_history_reply_content = $this->request->data['forum_reply_detail_content'];
                            $forumReplyHistory->forum_reply_id = $forum_reply_id;

                            if ($this->ForumReplyHistory->save($forumReplyHistory)) {
                                return $this->redirect(['controller' => 'ForumDiscussions','action' => 'forumReplies', $forum_category_name, $forum_topic_name , $forum_discussion_title]);
                            }
                        }
                    }
                }
            }
        }
    }

    public function forumDeleteReply($forum_category_name,$forum_topic_name,$forum_discussion_title)
     {

        $this->layout = false;
        $this->autoRender = false;

        $forum_reply_id = $this->request->data['forum_reply_id'];

        $this->loadModel('UserActivities');
        $this->loadModel('ForumActivities');
        $this->loadModel('ForumReplies');
        $this->loadModel('ForumReplyDetails');
        $this->loadModel('ForumReplyHistory');
        $this->loadModel('ForumCategories');
        $this->loadModel('ForumCategoryDetails');
        $this->loadModel('ForumTopics');
        $this->loadModel('ForumTopicDetails');
        $this->loadModel('ForumDiscussions');
        $this->loadModel('ForumDiscussionDetails');
        $this->loadModel('UserForumActivityCounts');

        $userActivity = $this->UserActivities->newEntity();
        $forumActivity = $this->ForumActivities->newEntity();

        $currentUser = $this->Auth->user('id');

        # begin post put

        if ($this->request->is(['post', 'put'])) {

            # begin save UserActivities

            $userActivity->user_activity_activity_type_id = 2;  # forum
            $userActivity->user_activity_user_id = $currentUser;

            if ($activityID = $this->UserActivities->save($userActivity)) {

                # begin save ForumActivities 

                $forumActivity->forum_activity_type_id = 13; # delete reply
                $forumActivity->forum_activity_user_id = $currentUser;
                $forumActivity->forum_activity_activity_id = $activityID->user_activity_id;

                if ($forumID = $this->ForumActivities->save($forumActivity)) {

                    # begin update ForumReplies

                    $forumReplyTable = TableRegistry::get('ForumReplies');
                    $forumReplyTable = TableRegistry::getTableLocator()->get('ForumReplies');
                    $forumReply = $forumReplyTable->get($forum_reply_id);

                    $forumReply->forum_reply_updated = date("Y-m-d H:i:s");
                    $forumReply->forum_reply_active = 0;

                    if ($forumReplyTable->save($forumReply)) {

                        # begin update ForumCategoryDetails 

                        $getCategoryID = $this->ForumCategories->find('all')->where(['ForumCategories.forum_category_name' => str_replace('-', ' ', $forum_category_name)])->first()->forum_category_id;

                        $getForumCategoryDetailID = $this->ForumCategoryDetails->find('all')->where(['ForumCategoryDetails.forum_category_detail_category_id' => $getCategoryID])->first()->forum_category_detail_id;

                        $forumCategoryDetailsTable = TableRegistry::get('ForumCategoryDetails');

                        $forumCategoryDetailsTable = TableRegistry::getTableLocator()->get('ForumCategoryDetails');
                        $forumCategoryDetail = $forumCategoryDetailsTable->get($getForumCategoryDetailID);

                        $forumCategoryDetail->forum_category_replies_count -= 1;


                        if ($forumCategoryDetailsTable->save($forumCategoryDetail)) {

                            # begin update ForumTopicDetails

                            $getForumTopicID = $this->ForumTopics->find('all')->where(['ForumTopics.forum_topic_name' => str_replace('-', ' ',$forum_topic_name)])->first()->forum_topic_id;

                            $getForumTopicDetailID = $this->ForumTopicDetails->find('all')->where(['ForumTopicDetails.forum_topic_detail_topic_id' => $getForumTopicID])->first()->forum_topic_detail_id;

                            $forumTopicDetailsTable = TableRegistry::get('ForumTopicDetails');

                            $forumTopicDetailsTable = TableRegistry::getTableLocator()->get('ForumTopicDetails');
                            $forumTopicDetail = $forumTopicDetailsTable->get($getForumTopicDetailID);

                            $forumTopicDetail->forum_topic_detail_replies_count -= 1;

                            if ($forumTopicDetailsTable->save($forumTopicDetail)) {

                                # begin update ForumDiscussionDetails

                                $getDiscussionID = $this->ForumDiscussions->find('all')->where(['ForumDiscussions.forum_discussion_title' => str_replace('-', ' ',$forum_discussion_title)])->first()->forum_discussion_id;

                                $getDiscussionDetailID = $this->ForumDiscussionDetails->find('all')->where(['ForumDiscussionDetails.forum_discussion_detail_discussion_id' => $getDiscussionID])->first()->forum_discussion_detail_id;

                                $discussionDetailsTable = TableRegistry::get('ForumDiscussionDetails');

                                $discussionDetailsTable = TableRegistry::getTableLocator()->get('ForumDiscussionDetails');
                                $discussionDetail = $discussionDetailsTable->get($getDiscussionDetailID);

                                $discussionDetail->forum_discussion_detail_replies_count -= 1;

                                if ($discussionDetailsTable->save($discussionDetail)) {

                                    # begin update UserForumActivityCounts

                                    $getUserForumActivityCountID = $this->UserForumActivityCounts->find('all')->where(['UserForumActivityCounts.user_id' => $currentUser])->first()->user_forum_activity_count_id;

                                    $forumActivityCountsTable = TableRegistry::get('UserForumActivityCounts');

                                    $forumActivityCountsTable = TableRegistry::getTableLocator()->get('UserForumActivityCounts');
                                    $forumActivityCount = $forumActivityCountsTable->get($getUserForumActivityCountID);

                                    $forumActivityCount->user_forum_activity_replies_count -= 1;

                                    if ($forumActivityCountsTable->save($forumActivityCount)) {

                                    }
                                    else {
                                        $this->log($forumActivityCount->errors(),'debug');
                                    }
                                    # end update UserForumActivityCounts
                                }
                                else {
                                    $this->log($forumDiscussionDetail->errors(),'debug');
                                }
                                # end update ForumDiscussionDetails
                            }
                            else {
                                $this->log($forumTopicDetail->errors(),'debug');
                            }
                            # end update ForumTopicDetails
                        }
                        else {
                            $this->log($forumCategoryDetail->errors(),'debug');
                        }
                        # end update ForumCategoryDetails 
                    }
                    else {
                        $this->log($forumReply->errors(),'debug');
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
        # end post put
    }

    public function forumReplyToReply($forum_category_name,$forum_topic_name,$forum_discussion_title,$forum_reply_id) {

        $this->loadModel('ForumReplies');
        $reply = $this->ForumReplies->find('all')->contain(['ForumReplyDetails','Users.UserProfiles','Users.UserTypes','Users.UserAdministrators','Users.UserEmployees.EmployeePositionNames','Users.UserStudents.Courses','Users.UserAlumni.Courses','Users.UserForumActivityCounts'])->where(['ForumReplies.forum_reply_id' => $forum_reply_id])->first();

        $parentReply = $this->ForumReplies->find('all')->contain([
            'ForumReplyDetails', 'ForumParentReplies.ForumReplyDetails', 'ForumParentReplies.Users.UserProfiles',
            'Users.UserProfiles','Users.UserTypes','Users.UserAdministrators',
            'Users.UserEmployees.EmployeePositionNames'=> 
                function (Query $query) { 
                    return $query->limit(['UserEmployees.user_id' => 'Users.id']);
                },
            'Users.UserStudents.Courses'=> 
                function (Query $query) { 
                    return $query->limit(['UserStudents.user_id' => 'Users.id']);
                },
            'Users.UserAlumni.Courses'=> 
                function (Query $query) { 
                    return $query->limit(['UserAlumni.user_id' => 'Users.id']);
                },
            'Users.UserForumActivityCounts'])->leftJoinWith('ForumParentReplies')
            ->where(['ForumReplies.forum_reply_id' => $forum_reply_id])->first();
        $this->set('reply', $reply);
        $this->log($parentReply,'debug');
        $this->set('parentReply',$parentReply);


        $discussion = $this->ForumDiscussions->find('all')->contain(['ForumDiscussionDetails','ForumTopics.ForumCategories','Users.UserProfiles','Users.UserTypes','Users.UserAdministrators','Users.UserEmployees.EmployeePositionNames','Users.UserStudents.Courses'=> function (Query $query) { return $query->limit(['UserStudents.user_id' => 'Users.id']);},'Users.UserAlumni.Courses','Users.UserForumActivityCounts'])->where(['ForumDiscussions.forum_discussion_title' => str_replace('-', ' ', $forum_discussion_title)])->first();
        $discussion_id = $discussion->forum_discussion_id;

        $this->set('discussion',$discussion);


        $this->loadModel('ForumCategories');
        $this->loadModel('ForumTopics');
        $this->loadModel('ForumDiscussions');
        $this->loadModel('ForumReplies');
        $this->loadModel('ForumReplyChild');
        $this->loadModel('UserActivities');
        $this->loadModel('ForumActivities');
        $this->loadModel('ForumReplyActivities');
        $this->loadModel('ForumReplyDetails');
        $this->loadModel('ForumCategoryDetails');
        $this->loadModel('ForumTopicDetails');
        $this->loadModel('ForumDiscussionDetails');
        $this->loadModel('UserForumActivityCounts');
        $this->loadModel('ForumReplyHistory');

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
        $forumReplyHistory = $this->ForumReplyHistory->newEntity();
        $forumReplyChild = $this->ForumReplyChild->newEntity();

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
                    $forumReply->forum_parent_reply_id = $forum_reply_id;

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

                                                    $forumReplyHistory->forum_reply_history_reply_content = $this->request->data['forum_reply_detail_content'];
                                                    $forumReplyHistory->forum_reply_id = $replyID->forum_reply_id;

                                                    if ($this->ForumReplyHistory->save($forumReplyHistory)) {

                                                        $this->Flash->success('Reply Added!', [
                                                            'params' => [
                                                                'saves' => 'Reply Added!'
                                                            ]
                                                        ]);
                                                        return $this->redirect(['controller' => 'ForumDiscussions','action' => 'forumReplies', $forum_category_name, $forum_topic_name , $forum_discussion_title]);
                                                    }
                                                }

                                            }
                                            else {

                                                $getUserForumActivityCountID = $this->UserForumActivityCounts->find('all')->where(['UserForumActivityCounts.user_id' => $currentUser])->first()->user_forum_activity_count_id;

                                                $forumActivityCountsTable = TableRegistry::get('UserForumActivityCounts');

                                                $forumActivityCountsTable = TableRegistry::getTableLocator()->get('UserForumActivityCounts');
                                                $forumActivityCount = $forumActivityCountsTable->get($getUserForumActivityCountID);

                                                $forumActivityCount->user_forum_activity_replies_count += 1;

                                                if ($forumActivityCountsTable->save($forumActivityCount)) {

                                                    $forumReplyHistory->forum_reply_history_reply_content = $this->request->data['forum_reply_detail_content'];
                                                    $forumReplyHistory->forum_reply_id = $replyID->forum_reply_id;

                                                    if ($this->ForumReplyHistory->save($forumReplyHistory)) {

                                                        $this->Flash->success('Reply Added!', [
                                                            'params' => [
                                                                'saves' => 'Reply Added!'
                                                            ]
                                                        ]);
                                                        return $this->redirect(['controller' => 'ForumDiscussions','action' => 'forumReplies', $forum_category_name, $forum_topic_name , $forum_discussion_title]);

                                                    }


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
                    # end ForumReplies
                }

            }
        }
    }

    public function forumDiscussionVote() {

        $this->layout = false; 
        $this->autoRender = false;

        $this->loadModel('UserActivities');
        $this->loadModel('ForumActivities');
        $this->loadModel('UserForumDiscussionVotes');
        $this->loadModel('ForumDiscussions');
        $this->loadModel('ForumDiscussionActivities');
        $this->loadModel('ForumDiscussionDetails');

        $userActivity = $this->UserActivities->newEntity();
        $forumActivity = $this->ForumActivities->newEntity();
        $forumDiscussionActivity = $this->ForumDiscussionActivities->newEntity();

        $currentUser = $this->Auth->user('id');

        $userDiscussionVote = $this->request->data('discussion_vote');
        $discussion_id = $this->request->data['discussion_id'];

        # begin post/put
        if ($this->request->is(['post','put'])) {

            # begin save UserActivities

            $userActivity->user_activity_activity_type_id = 2;
            $userActivity->user_activity_user_id = $currentUser;

            if ($activityID = $this->UserActivities->save($userActivity)) {

                # begin save ForumActivities 

                if ($userDiscussionVote == 'DiscussionUpvote' || $userDiscussionVote == 'DiscussionUpvoteCancelDownvote'  ) {
                    $forumActivity->forum_activity_type_id = 13; # Discussion Upvote
                }
                else if ($userDiscussionVote == 'DiscussionDownvote' || $userDiscussionVote == 'DiscussionDownvoteCancelUpvote') {
                    $forumActivity->forum_activity_type_id = 14; # Discussion Downvote
                }
                else if ($userDiscussionVote == 'DiscussionUpvoteCancel') {
                    $forumActivity->forum_activity_type_id = 15; # Discussion Cancel Upvote
                }
                else if ($userDiscussionVote == 'DiscussionDownvoteCancel') {
                    $forumActivity->forum_activity_type_id = 16; # Discussion Cancel Downvote
                }

                $forumActivity->forum_activity_user_id = $currentUser;
                $forumActivity->forum_activity_activity_id = $activityID->user_activity_id;

                if ($forumID = $this->ForumActivities->save($forumActivity)) {

                    # begin save ForumDiscussionActivities

                    $forumDiscussionActivity->forum_discussion_activity_forum_activity_id = $forumID->forum_activity_id;
                    $forumDiscussionActivity->forum_discussion_activity_forum_discussion_id = $discussion_id;

                    if ($forumDiscussionActivityID = $this->ForumDiscussionActivities->save($forumDiscussionActivity)) {
                    # begin save UserForumDiscussionVotes

                    $checkIfUserDiscussionVoteExists = $this->UserForumDiscussionVotes->find('all')->where(['UserForumDiscussionVotes.forum_discussion_id' => $discussion_id,'UserForumDiscussionVotes.user_id' => $currentUser]);

                    # if user has vote in UserForumDiscussionVotes in chosen discussion
                    if (!$checkIfUserDiscussionVoteExists->isEmpty()) {
                        $forum_discussion_vote_id = $checkIfUserDiscussionVoteExists->first()->forum_discussion_vote_id;

                        $forumDiscussionVoteTable = TableRegistry::get('UserForumDiscussionVotes');
                        $forumDiscussionVoteTable = TableRegistry::getTableLocator()->get('UserForumDiscussionVotes');
                        $forumDiscussionVote = $forumDiscussionVoteTable->get($forum_discussion_vote_id);

                        if ($userDiscussionVote == 'DiscussionUpvote') {
                            $forumDiscussionVote->forum_discussion_vote_upvote = true;
                            $this->log('Vote: DiscussionUpvote & DiscussionUpvoteCancelDownvote','debug');
                        }
                        else if ($userDiscussionVote == 'DiscussionUpvoteCancelDownvote') {
                            $forumDiscussionVote->forum_discussion_vote_upvote = true;
                            $forumDiscussionVote->forum_discussion_vote_downvote = false;
                        }
                        else if ($userDiscussionVote == 'DiscussionDownvote' ) {
                            $forumDiscussionVote->forum_discussion_vote_downvote = true;
                            $this->log('Vote: DiscussionDownvote','debug');
                        }
                        else if ($userDiscussionVote == 'DiscussionDownvoteCancelUpvote') {
                            $forumDiscussionVote->forum_discussion_vote_downvote = true;
                            $forumDiscussionVote->forum_discussion_vote_upvote = false;
                            $this->log('Vote: DiscussionDownvoteCancelUpvote','debug');
                        }
                        else if ($userDiscussionVote == 'DiscussionUpvoteCancel') {
                            $forumDiscussionVote->forum_discussion_vote_upvote = false;
                            $this->log('Vote: DiscussionUpvoteCancel','debug');
                        }
                        else if ($userDiscussionVote == 'DiscussionDownvoteCancel') {
                            $forumDiscussionVote->forum_discussion_vote_downvote = false;
                            $this->log('Vote: DiscussionDownvoteCancel','debug');
                        }

                        $forumDiscussionVote->forum_discussion_id = $discussion_id;
                        $forumDiscussionVote->user_id = $currentUser;

                        if ($forumDiscussionVoteTable->save($forumDiscussionVote)) {

                            # begin save ForumDiscussionDetails

                            $forumDiscussionDetailsTable = TableRegistry::get('ForumDiscussionDetails');
                            $forumDiscussionDetailsTable = TableRegistry::getTableLocator()->get('ForumDiscussionDetails');
                            $forumDiscussionDetail = $forumDiscussionDetailsTable->get($discussion_id);

                            if ($userDiscussionVote == 'DiscussionUpvote') {
                                $forumDiscussionDetail->forum_discussion_detail_upvote_count += 1;
                            }
                            else if ($userDiscussionVote == 'DiscussionUpvoteCancelDownvote') {
                                $forumDiscussionDetail->forum_discussion_detail_upvote_count += 1;
                                $forumDiscussionDetail->forum_discussion_detail_downvote_count -= 1;
                            }
                            else if ($userDiscussionVote == 'DiscussionDownvote') {
                                $forumDiscussionDetail->forum_discussion_detail_downvote_count += 1;
                            }
                            else if ($userDiscussionVote == 'DiscussionDownvoteCancelUpvote') {
                                $forumDiscussionDetail->forum_discussion_detail_downvote_count += 1;
                                $forumDiscussionDetail->forum_discussion_detail_upvote_count -= 1;
                            }
                            else if ($userDiscussionVote == 'DiscussionUpvoteCancel') {
                                $forumDiscussionDetail->forum_discussion_detail_upvote_count -= 1;
                            }
                            else if ($userDiscussionVote == 'DiscussionDownvoteCancel') {
                                $forumDiscussionDetail->forum_discussion_detail_downvote_count -= 1;
                            }

                            if ($forumDiscussionDetailsTable->save($forumDiscussionDetail)) {

                                # begin save UserNotifications

                                $this->loadModel('UserNotifications');
                                $user_notification = $this->UserNotifications->newEntity();

                                $forum_discussion_user_id = $this->ForumDiscussions->find('all')->where(['ForumDiscussions.forum_discussion_id' => $discussion_id])->first()->forum_discussion_created_by_user_id;

                                $user_notification->user_notification_receiver_user_id = $forum_discussion_user_id;

                                if ($userNotification = $this->UserNotifications->save($user_notification)) {

                                    # begin save ForumNotifications

                                    $this->loadModel('ForumNotifications');

                                    $forum_notification = $this->ForumNotifications->newEntity();

                                    $forum_notification_type_id = 0;

                                    if ($userDiscussionVote == 'DiscussionUpvote' || $userDiscussionVote == 'DiscussionUpvoteCancelDownvote') {
                                        $forum_notification_type_id = 3;
                                    }
                                    else if ($userDiscussionVote == 'DiscussionDownvote' || $userDiscussionVote == 'DiscussionDownvoteCancelUpvote') {
                                        $forum_notification_type_id = 4;
                                    }
                                    else if ($userDiscussionVote == 'DiscussionUpvoteCancel') {
                                        $forum_notification_type_id = 5;
                                    }
                                    else if ($userDiscussionVote == 'DiscussionDownvoteCancel') {
                                        $forum_notification_type_id = 6;
                                    }

                                    $forum_notification->user_notification_id = $userNotification->user_notification_id;
                                    $forum_notification->forum_notification_sender_user_id = $currentUser;
                                    $forum_notification->forum_notification_type_id = $forum_notification_type_id; # Discussion Reaction
                                    $forum_notification->forum_notification_discussion_id = $discussion_id;

                                    if ($this->ForumNotifications->save($forum_notification)) {

                                    }
                                    else {
                                        $this->log($forum_notification->errors(),'debug');
                                    }
                                    # end save ForumNotifications
                                }
                                else {
                                    $this->log($user_notification->errors(),'debug');
                                }
                                # end save UserNotifications
                            }
                            else {
                                $this->log($forumDiscussionDetail->errors(),'debug');
                            }
                            # end update ForumDiscussionDetails
                        }
                        else {
                            $this->log($forumDiscussionVote->errors(),'debug');
                        }
                        # end update forumDiscussionVote
                    }
                    # end if user has vote in UserForumDiscussionVotes in chosen discussion

                    # begin if user doesn't have a vote in UserForumDiscussionVotes in chosen discussion
                    else {
                        $forumDiscussionVote = $this->UserForumDiscussionVotes->newEntity();

                        if ($userDiscussionVote == 'DiscussionUpvote') {
                            $forumDiscussionVote->forum_discussion_vote_upvote = true;
                        }
                        else if ($userDiscussionVote == 'DiscussionDownvote') {
                            $forumDiscussionVote->forum_discussion_vote_downvote = true;
                        }

                        $forumDiscussionVote->forum_discussion_id = $discussion_id;
                        $forumDiscussionVote->user_id = $currentUser;

                        if ($this->UserForumDiscussionVotes->save($forumDiscussionVote)) {

                            # begin save ForumDiscussionDetails

                            $forumDiscussionDetailsTable = TableRegistry::get('ForumDiscussionDetails');
                            $forumDiscussionDetailsTable = TableRegistry::getTableLocator()->get('ForumDiscussionDetails');
                            $forumDiscussionDetail = $forumDiscussionDetailsTable->get($discussion_id);

                            if ($userDiscussionVote == 'DiscussionUpvote') {
                                $forumDiscussionDetail->forum_discussion_detail_upvote_count += 1;
                            }
                            else if ($userDiscussionVote == 'DiscussionUpvoteCancelDownvote') {
                                $forumDiscussionDetail->forum_discussion_detail_upvote_count += 1;
                                $forumDiscussionDetail->forum_discussion_detail_downvote_count -= 1;
                            }
                            else if ($userDiscussionVote == 'DiscussionDownvote') {
                                $forumDiscussionDetail->forum_discussion_detail_downvote_count += 1;
                            }
                            else if ($userDiscussionVote == 'DiscussionDownvoteCancelUpvote') {
                                $forumDiscussionDetail->forum_discussion_detail_downvote_count += 1;
                                $forumDiscussionDetail->forum_discussion_detail_upvote_count -= 1;
                            }
                            else if ($userDiscussionVote == 'DiscussionUpvoteCancel') {
                                $forumDiscussionDetail->forum_discussion_detail_upvote_count -= 1;
                            }
                            else if ($userDiscussionVote == 'DiscussionDownvoteCancel') {
                                $forumDiscussionDetail->forum_discussion_detail_downvote_count -= 1;
                            }

                            if ($forumDiscussionDetailsTable->save($forumDiscussionDetail)) {

                                # begin save UserNotifications

                                $this->loadModel('UserNotifications');
                                $user_notification = $this->UserNotifications->newEntity();

                                $forum_discussion_user_id = $this->ForumDiscussions->find('all')->where(['ForumDiscussions.forum_discussion_id' => $discussion_id])->first()->forum_discussion_created_by_user_id;

                                $user_notification->user_notification_receiver_user_id = $forum_discussion_user_id;

                                if ($userNotification = $this->UserNotifications->save($user_notification)) {

                                    # begin save ForumNotifications

                                    $this->loadModel('ForumNotifications');

                                    $forum_notification = $this->ForumNotifications->newEntity();
                                    
                                    $forum_notification_type_id = 0;

                                    if ($userDiscussionVote == 'DiscussionUpvote' || $userDiscussionVote == 'DiscussionUpvoteCancelDownvote') {
                                        $forum_notification_type_id = 3;
                                    }
                                    else if ($userDiscussionVote == 'DiscussionDownvote' || $userDiscussionVote == 'DiscussionDownvoteCancelUpvote') {
                                        $forum_notification_type_id = 4;
                                    }
                                    else if ($userDiscussionVote == 'DiscussionUpvoteCancel') {
                                        $forum_notification_type_id = 5;
                                    }
                                    else if ($userDiscussionVote == 'DiscussionDownvoteCancel') {
                                        $forum_notification_type_id = 6;
                                    }

                                    $forum_notification->user_notification_id = $userNotification->user_notification_id;
                                    $forum_notification->forum_notification_sender_user_id = $currentUser;
                                    $forum_notification->forum_notification_type_id = $forum_notification_type_id; # Discussion Reaction
                                    $forum_notification->forum_notification_discussion_id = $discussion_id;

                                    if ($this->ForumNotifications->save($forum_notification)) {

                                    }
                                    else {
                                        $this->log($forum_notification->errors(),'debug');
                                    }
                                    # end save ForumNotifications
                                }
                                else {
                                    $this->log($user_notification->errors(),'debug');
                                }
                                # end save UserNotifications
                            }
                            else {
                                $this->log($forumDiscussionDetail->errors(),'debug');
                            }
                            # end update ForumDiscussionDetails
                        }
                        else {
                            $this->log($forumDiscussionVote->errors(),'debug');
                        }
                    }
                    # end if user doesn't have a vote in UserForumDiscussionVotes in chosen discussion
                    }
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
        # end post/put
    }

    public function forumReplyVote() {
        $this->layout = false; 
        $this->autoRender = false;

        $this->loadModel('UserActivities');
        $this->loadModel('ForumActivities');
        $this->loadModel('UserForumReplyVotes');
        $this->loadModel('ForumReplyDetails');
        $this->loadModel('ForumReplies');
        $this->loadModel('ForumReplyActivities');

        $userActivity = $this->UserActivities->newEntity();
        $forumActivity = $this->ForumActivities->newEntity();
        $forumReplyActivity = $this->ForumReplyActivities->newEntity();

        $currentUser = $this->Auth->user('id');

        $userReplyVote = $this->request->data['reply_vote'];
        $reply_id = $this->request->data['reply_id'];

        $discussion_id = $this->ForumReplies->find('all')->where(['ForumReplies.forum_reply_id' => $reply_id])->first()->forum_discussion_id;

        if ($this->request->is(['post','put'])) {
            
            # begin save UserActivities

            $userActivity->user_activity_activity_type_id = 2;
            $userActivity->user_activity_user_id = $currentUser;

            if ($activityID = $this->UserActivities->save($userActivity)) {

                # begin save ForumActivities 

                if ($userReplyVote == 'ReplyUpvote' || $userReplyVote == 'ReplyUpvoteCancelDownvote'  ) {
                    $forumActivity->forum_activity_type_id = 17; # create discussion vote
                }
                else if ($userReplyVote == 'ReplyDownvote' || $userReplyVote == 'ReplyDownvoteCancelUpvote') {
                    $forumActivity->forum_activity_type_id = 18; # cancel discussion vote
                }
                else if ($userReplyVote == 'ReplyUpvoteCancel') {
                    $forumActivity->forum_activity_type_id = 19; # cancel discussion vote
                }
                else if ($userReplyVote == 'ReplyDownvoteCancel') {
                    $forumActivity->forum_activity_type_id = 20; # cancel discussion vote
                }

                $forumActivity->forum_activity_user_id = $currentUser;
                $forumActivity->forum_activity_activity_id = $activityID->user_activity_id;

                if ($forumID = $this->ForumActivities->save($forumActivity)) {
                    
                    $forumReplyActivity->forum_reply_activity_forum_activity_id = $forumID->forum_activity_id;
                    $forumReplyActivity->forum_reply_activity_forum_reply_id = $reply_id;

                    if ($replyActivityID = $this->ForumReplyActivities->save($forumReplyActivity)) {

                    # begin save UserForumReplyVotes

                    $checkIfUserReplyVoteExists = $this->UserForumReplyVotes->find('all')->where(['UserForumReplyVotes.forum_reply_id' => $reply_id,'UserForumReplyVotes.user_id' => $currentUser]);

                    # begin if user has vote in UserForumReplyVotes in chosen reply
                    if (!$checkIfUserReplyVoteExists->isEmpty()) {
                        $forum_reply_vote_id = $checkIfUserReplyVoteExists->first()->forum_reply_vote_id;

                        # begin save UserForumReplyVotes

                        $forumReplyVoteTable = TableRegistry::get('UserForumReplyVotes');
                        $forumReplyVoteTable = TableRegistry::getTableLocator()->get('UserForumReplyVotes');
                        $forumReplyVote = $forumReplyVoteTable->get($forum_reply_vote_id);

                        if ($userReplyVote == 'ReplyUpvote') {
                            $forumReplyVote->forum_reply_vote_upvote = true;
                            $this->log('Vote: ReplyUpvote','debug');
                        }
                        else if ($userReplyVote == 'ReplyUpvoteCancelDownvote') {
                            $forumReplyVote->forum_reply_vote_upvote = true;
                            $forumReplyVote->forum_reply_vote_downvote = false;
                            $this->log('Vote: ReplyUpvoteCancelDownvote','debug');
                        }
                        else if ($userReplyVote == 'ReplyDownvote' ) {
                            $forumReplyVote->forum_reply_vote_downvote = true;
                            $this->log('Vote: ReplyDownvote','debug');
                        }
                        else if ($userReplyVote == 'ReplyDownvoteCancelUpvote') {
                            $forumReplyVote->forum_reply_vote_downvote = true;
                            $forumReplyVote->forum_reply_vote_upvote = false;
                            $this->log('Vote: ReplyDownvoteCancelUpvote','debug');
                        }
                        else if ($userReplyVote == 'ReplyUpvoteCancel') {
                            $forumReplyVote->forum_reply_vote_upvote = false;
                            $this->log('Vote: ReplyUpvoteCancel','debug');
                        }
                        else if ($userReplyVote == 'ReplyDownvoteCancel') {
                            $forumReplyVote->forum_reply_vote_downvote = false;
                            $this->log('Vote: ReplyDownvoteCancel','debug');
                        }

                        $forumReplyVote->forum_reply_id = $reply_id;
                        $forumReplyVote->user_id = $currentUser;

                        if ($forumReplyVoteTable->save($forumReplyVote)) {

                            # begin update ForumReplyDetails

                            $forum_reply_detail_id = $this->ForumReplyDetails->find('all')->where(['ForumReplyDetails.forum_reply_detail_forum_reply_id' => $reply_id])->first()->forum_reply_detail_id;

                            $forumReplyDetailsTable = TableRegistry::get('ForumReplyDetails');
                            $forumReplyDetailsTable = TableRegistry::getTableLocator()->get('ForumReplyDetails');
                            $forumReplyDetail = $forumReplyDetailsTable->get($forum_reply_detail_id);

                            if ($userReplyVote == 'ReplyUpvote') {
                                $forumReplyDetail->forum_reply_detail_likes_count += 1;
                                $this->log('Details: ReplyUpvote','debug');
                            }
                            else if ($userReplyVote == 'ReplyUpvoteCancelDownvote') {
                                $forumReplyDetail->forum_reply_detail_likes_count += 1;
                                $forumReplyDetail->forum_reply_detail_dislikes_count -= 1;
                                $this->log('Details: ReplyUpvoteCancelDownvote','debug');
                            }
                            else if ($userReplyVote == 'ReplyDownvote') {
                                $forumReplyDetail->forum_reply_detail_dislikes_count += 1;
                                $this->log('Details: ReplyDownvote','debug');
                            }
                            else if ($userReplyVote == 'ReplyDownvoteCancelUpvote') {
                                $forumReplyDetail->forum_reply_detail_dislikes_count += 1;
                                $forumReplyDetail->forum_reply_detail_likes_count -= 1;
                                $this->log('Details: ReplyDownvoteCancelUpvote','debug');
                            }
                            else if ($userReplyVote == 'ReplyUpvoteCancel') {
                                $forumReplyDetail->forum_reply_detail_likes_count -= 1;
                                $this->log('Details: ReplyUpvoteCancel','debug');
                            }
                            else if ($userReplyVote == 'ReplyDownvoteCancel') {
                                $forumReplyDetail->forum_reply_detail_dislikes_count -= 1;
                                $this->log('Details: ReplyDownvoteCancel','debug');
                            }

                            if ($forumReplyDetailsTable->save($forumReplyDetail)) {

                                # begin save UserNotifications

                                $this->loadModel('UserNotifications');
                                $user_notification = $this->UserNotifications->newEntity();

                                $forum_reply_created_by_user_id = $this->ForumReplies->find('all')->where(['ForumReplies.forum_reply_id' => $reply_id])->first()->forum_reply_created_by_user_id;

                                $user_notification->user_notification_receiver_user_id = $forum_reply_created_by_user_id;

                                if ($userNotification = $this->UserNotifications->save($user_notification)) {

                                    # begin save ForumNotifications

                                    $this->loadModel('ForumNotifications');

                                    if ($userReplyVote == 'ReplyUpvote' || $userReplyVote == 'ReplyUpvoteCancelDownvote'  ) {
                                        $forum_notification_type_id = 7; # create discussion vote
                                    }
                                    else if ($userReplyVote == 'ReplyDownvote' || $userReplyVote == 'ReplyDownvoteCancelUpvote') {
                                        $forum_notification_type_id = 8; # cancel discussion vote
                                    }
                                    else if ($userReplyVote == 'ReplyUpvoteCancel') {
                                        $forum_notification_type_id = 9; # cancel discussion vote
                                    }
                                    else if ($userReplyVote == 'ReplyDownvoteCancel') {
                                        $forum_notification_type_id = 10; # cancel discussion vote
                                    }

                                    $forum_notification = $this->ForumNotifications->newEntity();

                                    $forum_notification->user_notification_id = $userNotification->user_notification_id;
                                    $forum_notification->forum_notification_sender_user_id = $currentUser;
                                    $forum_notification->forum_notification_type_id = $forum_notification_type_id; # 
                                    $forum_notification->forum_notification_discussion_id = $discussion_id;
                                    $forum_notification->forum_notification_reply_id = $reply_id;

                                    if ($this->ForumNotifications->save($forum_notification)) {

                                    }
                                    else {
                                        $this->log($forum_notification->errors(),'debug');
                                    }
                                    # end save ForumNotifications
                                }
                                else {
                                    $this->log($user_notification->errors(),'debug');
                                }
                                # end save UserNotifications
                            }
                            else {
                                $this->log($forumReplyDetail->errors(),'debug');
                            }
                            # end update ForumReplyDetails
                        }
                        else {
                            $this->log($forumReplyVote->errors(),'debug');
                        }
                        # end save UserForumReplyVotes
                    }
                    # end if user has vote in UserForumReplyVotes in chosen reply

                    # begin if user doesn't have a vote in UserForumReplyVotes in chosen reply
                    else {

                        # begin save UserForumReplyVotes
                        $forumReplyVote = $this->UserForumReplyVotes->newEntity();

                        if ($userReplyVote == 'ReplyUpvote') {
                            $forumReplyVote->forum_reply_vote_upvote = true;
                            $this->log('up '. $forumReplyVote->forum_reply_vote_upvote,'debug');
                        }
                        else if ($userReplyVote == 'ReplyDownvote') {
                            $forumReplyVote->forum_reply_vote_downvote = true;
                            $this->log('down '. $forumReplyVote->forum_reply_vote_downvote,'debug');
                        }

                        $forumReplyVote->forum_reply_id = $reply_id;
                        $forumReplyVote->user_id = $currentUser;

                        if ($this->UserForumReplyVotes->save($forumReplyVote)) {

                            # begin save ForumReplyDetails

                            $forum_reply_detail_id = $this->ForumReplyDetails->find('all')->where(['ForumReplyDetails.forum_reply_detail_forum_reply_id' => $reply_id])->first()->forum_reply_detail_id;

                            $forumReplyDetailsTable = TableRegistry::get('ForumReplyDetails');
                            $forumReplyDetailsTable = TableRegistry::getTableLocator()->get('ForumReplyDetails');
                            $forumReplyDetail = $forumReplyDetailsTable->get($forum_reply_detail_id);

                            if ($userReplyVote == 'ReplyUpvote') {
                                $forumReplyDetail->forum_reply_detail_likes_count += 1;
                            }
                            else if ($userReplyVote == 'ReplyUpvoteCancelDownvote') {
                                $forumReplyDetail->forum_reply_detail_likes_count += 1;
                                $forumReplyDetail->forum_reply_detail_dislikes_count -= 1;
                            }
                            else if ($userReplyVote == 'ReplyDownvote') {
                                $forumReplyDetail->forum_reply_detail_dislikes_count += 1;
                            }
                            else if ($userReplyVote == 'ReplyDownvoteCancelUpvote') {
                                $forumReplyDetail->forum_reply_detail_dislikes_count += 1;
                                $forumReplyDetail->forum_reply_detail_likes_count -= 1;
                            }
                            else if ($userReplyVote == 'ReplyUpvoteCancel') {
                                $forumReplyDetail->forum_reply_detail_likes_count -= 1;
                            }
                            else if ($userReplyVote == 'ReplyDownvoteCancel') {
                                $forumReplyDetail->forum_reply_detail_dislikes_count -= 1;
                            }

                            if ($forumReplyDetailsTable->save($forumReplyDetail)) {
                                # begin save UserNotifications

                                $this->loadModel('UserNotifications');
                                $user_notification = $this->UserNotifications->newEntity();

                                $forum_reply_created_by_user_id = $this->ForumReplies->find('all')->where(['ForumReplies.forum_reply_id' => $reply_id])->first()->forum_reply_created_by_user_id;

                                $user_notification->user_notification_receiver_user_id = $forum_reply_created_by_user_id;

                                if ($userNotification = $this->UserNotifications->save($user_notification)) {

                                    # begin save ForumNotifications

                                    $this->loadModel('ForumNotifications');

                                    if ($userReplyVote == 'ReplyUpvote' || $userReplyVote == 'ReplyUpvoteCancelDownvote'  ) {
                                        $forum_notification_type_id = 7; # create discussion vote
                                    }
                                    else if ($userReplyVote == 'ReplyDownvote' || $userReplyVote == 'ReplyDownvoteCancelUpvote') {
                                        $forum_notification_type_id = 8; # cancel discussion vote
                                    }
                                    else if ($userReplyVote == 'ReplyUpvoteCancel') {
                                        $forum_notification_type_id = 9; # cancel discussion vote
                                    }
                                    else if ($userReplyVote == 'ReplyDownvoteCancel') {
                                        $forum_notification_type_id = 10; # cancel discussion vote
                                    }

                                    $forum_notification = $this->ForumNotifications->newEntity();

                                    $forum_notification->user_notification_id = $userNotification->user_notification_id;
                                    $forum_notification->forum_notification_sender_user_id = $currentUser;
                                    $forum_notification->forum_notification_type_id = $forum_notification_type_id;
                                    $forum_notification->forum_notification_discussion_id = $discussion_id;
                                    $forum_notification->forum_notification_reply_id = $reply_id;

                                    if ($this->ForumNotifications->save($forum_notification)) {

                                    }
                                    else {
                                        $this->log($forum_notification->errors(),'debug');
                                    }
                                    # end save ForumNotifications
                                }
                                else {
                                    $this->log($user_notification->errors(),'debug');
                                }
                                # end save UserNotifications
                            }
                            else {
                                $this->log($forumReplyDetail->errors(),'debug');
                            }
                            # end save ForumReplyDetails
                        }   
                        else {
                            $this->log($forumReplyVote->errors(),'debug');
                        }
                        # end save UserForumReplyVotes
                    }
                    # end if user doesn't have a vote in UserForumReplyVotes in chosen reply
                    }
                    else {
                        $this->log($forumReplyActivity->errors(),'debug');
                    }
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

    public function isAuthorized($user) {

        if (in_array($this->request->action, ['forumDiscussionsIndex', 'forumAddDiscussion','forumAddReply','forumDiscussions','forumReplies','forumEditReply','forumDeleteReply','forumEditDiscussion','forumDeleteDiscussion','forumReplyToReply','forumDiscussionVote','forumReplyVote','employeeEdit','studentsAll','studentAdd','studentEdit','alumniAll','alumniAdd','alumniEdit','deleteUser','logout'])) {
            return true;
        }

        return parent::isAuthorized($user);
    }

}
