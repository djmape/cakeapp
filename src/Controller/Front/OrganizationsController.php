<?php
// src/Controller/AdminController.php

namespace App\Controller\Front;

use App\Controller\AppController;
use Cake\Mailer\Email;
use App\Form\EmailForm;
use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

class OrganizationsController extends AppController
{

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
        $this->Auth->allow(['index']);
        $this->navBar('organizations');
        $this->checkLoginStatus();
        $this->Auth->allow('eventView');
        $this->Auth->allow('announcementView');
    }

    public function index()
    {

    }

    public function view($organization_id)
	{
        $this->loadModel('Organizations');

        $organization = $this->Organizations->find('all', 
                   array('conditions'=>array('Organizations.organization_id'=>$organization_id)));
        $organization = $organization->first();
        $this->title('PUPQC | ' . $organization->organization_name);


        if ($organization->active == 0) {
            return $this->redirect(['prefix' => 'front','controller' => 'home','action' => 'error404']);
        }
        else {

        $this->set('organization', $organization);

        $this->loadModel('OrganizationOfficers');
        $organization_officers = $this->OrganizationOfficers->find('all')->contain(['OrganizationOfficersPositions' => ['sort' => ['OrganizationOfficersPositions.officers_position_priority' => 'DESC']],'Organizations'])->innerJoinWith('OrganizationOfficersPositions')->order(['OrganizationOfficersPositions.officers_position_priority' => 'ASC'])->where(['Organizations.organization_id' => $organization_id])->where(['OrganizationOfficers.active' => 1]);
        $organization_officers = $this->Paginator->paginate($organization_officers);
        $this->set('organization_officers', $organization_officers);
    }
	}

    public function add()
    {
        $query = $this->Abouts->find('all', [
            'order' => ['Abouts.about_modified' => 'DESC']
        ]);
        $row = $query->first();

        $about = $this->Abouts->newEntity();
        if ($this->request->is('post')) {
            $about = $this->Abouts->patchEntity($about, $this->request->getData());

            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.

            if ($this->Abouts->save($about)) {
                $this->Flash->success(__('Your article has been saved.'));
            }
            else {
                debug($about->errors("?"));
            }
                $this->log('Got here', 'debug');
            
            $this->Flash->error(__('Unable to add your article.'));  
        }
        // Get a list of tags.

        $this->set('about', $about);
        $this->set('row', $row);
    }

    public function edit($slug)
    {
        $article = $this->Articles->findBySlug($slug)->contain('Tags')->firstOrFail();
        if ($this->request->is(['post', 'put'])) {
            $this->Articles->patchEntity($article, $this->request->getData(), [
            'accessibleFields' => ['user_id' => false]
        ]);
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your article.'));
        }
        // Get a list of tags.
        $tags = $this->Articles->Tags->find('list');

        // Set tags to the view context
        $this->set('tags', $tags);

        $this->set('article', $article);
    }

    public function eventView($organization_event_id)
    {   
        $email = new EmailForm();
        $this->set('email', $email);

        $this->loadModel('OrganizationEvents');
        $this->loadModel('PostReactions');
        $this->loadModel('UserPostReactions');
        $this->loadModel('PostComments');
        $this->loadModel('PostCommentContents');

        $this->updateEventStatus();        
        $currentUser = $this->Auth->user('id');

        $organization_event = $this->OrganizationEvents->find('all')->where(['OrganizationEvents.organization_event_id' => $organization_event_id]);

        $this->title('PUPQC | ' . $organization_event->first()->organization_event_title);

        $organization_event = $organization_event->first();
        $organization_event->organization_event_start_date = $organization_event->organization_event_start_date->format('l, F d, Y');
        $organization_event->organization_event_start_time = $organization_event->organization_event_start_time->format('g:i A');
        $organization_event->organization_event_end_date = $organization_event->organization_event_end_date->format('l, F d, Y');
        $organization_event->organization_event_end_time = $organization_event->organization_event_end_time->format('g:i A');

        $post_id = $organization_event->event_post_id;

        $getCurrentReaction = $this->UserPostReactions->find('all')->where(['UserPostReactions.user_post_reaction_user_id' => $currentUser])->where(['UserPostReactions.user_post_reaction_post_id' => $post_id]);
        $currentReaction = '';
        $getReactionsCountAvailable = false;

        $getReactionsCount = $this->PostReactions->find('all')->where(['PostReactions.post_reactions_post_id' => $post_id]);

        if ($getReactionsCount->count() > 0) {
            $getReactionsCountAvailable = true;
            $getReactionsCount = $getReactionsCount->first();
        }


        if ($getCurrentReaction->count() > 0) {
            if ($getCurrentReaction->first()->user_post_reaction_like == true) {
                $currentReaction = 'Like';
            }
            else if ($getCurrentReaction->first()->user_post_reaction_dislike == true) {
                $currentReaction = 'Dislike';
            }
        }

        $this->log($currentReaction,'debug');

        $postCommentContents = $this->paginate($this->PostCommentContents->find('all')->contain(['PostComments','PostComments.Users.UserProfiles'])->where(['PostComments.post_comment_post_id' => $post_id]));
        $this->set(compact('postCommentContents'));

        $this->set('organization_event', $organization_event);
        $this->set('getReactionsCountAvailable', $getReactionsCountAvailable);
        $this->set('currentReaction', $currentReaction);
        $this->set('reactions', $getReactionsCount);
    }

    public function saveEventPostReactions() {

        $this->layout = false; 
        $this->autoRender = false;

        $this->loadModel('UserActivities');
        $this->loadModel('UserPostActivities');
        $this->loadModel('UserPostReactions');
        $this->loadModel('PostReactions');
        $this->loadModel('OrganizationEvents');

        $organization_event_id = $this->request->data('organization_event_id');
        $post_id = $this->OrganizationEvents->find('all')->where(['OrganizationEvents.organization_event_id' => $organization_event_id])->first()->event_post_id;

        $currentUser = $this->Auth->user('id');

        $userActivity = $this->UserActivities->newEntity();
        $userPostActivity = $this->UserPostActivities->newEntity();
        $userPostReactions = $this->UserPostReactions->newEntity();

        if ($this->request->is(['post','put'])) {

            $userActivity->user_activity_activity_type_id = 1; # posts
            $userActivity->user_activity_user_id = $currentUser;
            $userActivity->user_activity_post_id = $post_id;

            if ($activityID = $this->UserActivities->save($userActivity)) {

                $userPostActivity->user_post_activity_user_id = $currentUser;
                $userPostActivity->user_post_activity_type_id = 3; # reaction
                $userPostActivity->user_post_activity_post_id = $post_id;
                $userPostActivity->user_post_activities_user_activity_id = $activityID->user_activity_id;

                if ($postActivityID = $this->UserPostActivities->save($userPostActivity)) {

                    $reaction = $this->request->data('reaction');

                    // begin save UserPostReactions

                    $checkIfUserPostReactionRowExists = $this->UserPostReactions->find('all')->where(['UserPostReactions.user_post_reaction_user_id' => $currentUser])->where(['UserPostReactions.user_post_reaction_post_id' => $post_id]);

                    
                    if (!$checkIfUserPostReactionRowExists->isEmpty()) {

                        $user_post_reactions_id = $checkIfUserPostReactionRowExists->first()->user_post_reactions_id;

                        $this->log("not empty",'debug');

                        $userPostReactionsTable = TableRegistry::get('UserPostReactions');
                        $userPostReactionsTable = TableRegistry::getTableLocator()->get('UserPostReactions');
                        $userPostReaction = $userPostReactionsTable->get($user_post_reactions_id);

                        if ($reaction == 'Like') {
                            $userPostReaction->user_post_reaction_like = true;
                        }
                        else if ($reaction == 'LikeCancelDislike') {
                            $userPostReaction->user_post_reaction_like = true;
                            $userPostReaction->user_post_reaction_dislike = false;
                        }
                        else if ($reaction == 'LikeCancel') {
                            $userPostReaction->user_post_reaction_like = false;
                        }
                        else if ($reaction == 'Dislike') {
                            $userPostReaction->user_post_reaction_dislike = true;
                        }
                        else if ($reaction == 'DislikeCancelLike') {
                            $userPostReaction->user_post_reaction_dislike = true;
                            $userPostReaction->user_post_reaction_like = false;
                        }
                        else if ($reaction == 'DislikeCancel') {
                            $userPostReaction->user_post_reaction_dislike = false;
                        }

                        $userPostReaction->user_post_reaction_post_id = $post_id;
                        $userPostReaction->user_post_reaction_user_id = $currentUser;
                        $userPostReaction->user_post_reaction_post_activity_id = $postActivityID->user_post_activity_id;
                        $userPostReaction->user_post_reactions_activity_id = $activityID->user_activity_id;

                        if ($userPostReactionsTable->save($userPostReaction)) {

                        }
                        else {
                            $this->log($userPostReaction->errors(),'debug');
                        }
                    }
                    else {

                        if ($reaction == 'Like') {
                            $userPostReactions->user_post_reaction_like = true;
                        }
                        else if ($reaction == 'Dislike') {
                            $userPostReactions->user_post_reaction_dislike = true;
                        }

                        $userPostReactions->user_post_reaction_post_id = $post_id;
                        $userPostReactions->user_post_reaction_user_id = $currentUser;
                        $userPostReactions->user_post_reaction_post_activity_id = $postActivityID->user_post_activity_id;
                        $userPostReactions->user_post_reactions_activity_id = $activityID->user_activity_id;

                        if ($this->UserPostReactions->save($userPostReactions)) {
                        }
                        else {
                            $this->log($userPostReactions->errors(),'debug');
                        }
                    }
                    // end save UserPostReactions

                    // begin save PostReactions
                    $checkIfPostReactionRowExists = $this->PostReactions->find('all')->where(['PostReactions.post_reactions_post_id' => $post_id]);

                    $this->log('check' . $checkIfPostReactionRowExists,'debug');

                    // begin if PostReaction row exists
                    if (!$checkIfPostReactionRowExists->isEmpty()) {

                        $post_reactions_id = $checkIfPostReactionRowExists->first()->post_reactions_id;

                        $postReactionsTable = TableRegistry::get('PostReactions');
                        $postReactionsTable = TableRegistry::getTableLocator()->get('PostReactions');
                        $postReaction = $postReactionsTable->get($post_reactions_id);

                        if ($reaction == 'Like') {
                            $postReaction->post_likes_count += 1;
                        }
                        else if ($reaction == 'LikeCancelDislike') {
                            $postReaction->post_likes_count += 1;
                            $postReaction->post_dislikes_count -= 1;
                        }
                        else if ($reaction == 'LikeCancel') {
                            $postReaction->post_likes_count -= 1;
                        }
                        else if ($reaction == 'Dislike') {
                            $postReaction->post_dislikes_count += 1;
                        }
                        else if ($reaction == 'DislikeCancelLike') {
                            $postReaction->post_dislikes_count += 1;
                            $postReaction->post_likes_count -= 1;
                        }
                        else if ($reaction == 'DislikeCancel') {
                            $postReaction->post_dislikes_count -= 1;
                        }

                        $postReaction->post_reactions_post_id = $post_id;
                        if ($getpostReactionsID = $postReactionsTable->save($postReaction)) {
                            
                        }
                        else {
                            $this->log($postReaction->errors(),'debug');
                        }
                    }
                    // end if PostReaction row exists
                    // begin if PostReaction row doesn't exists
                    else {
                        $postReactions = $this->PostReactions->newEntity();

                        if ($reaction == 'Like') {
                            $postReactions->post_likes_count += 1;
                        }
                        else if ($reaction == 'Dislike') {
                            $postReactions->post_dislikes_count += 1;
                        }

                        $postReactions->post_reactions_post_id = $post_id;
                        if ($this->PostReactions->save($postReactions)) {

                        }
                        else {
                            $this->log($postReactions->errors(),'debug');
                        }
                    }
                    // end if PostReaction row doesn't exists                    
                }
                // end save UserPostReactions
            }
            // end saving data
        }
        // end post/put
    }


    public function saveEventPostComment() 
    {
        $this->layout = false; 
        $this->autoRender = false;

        $this->loadModel('UserActivities');
        $this->loadModel('UserPostActivities');
        $this->loadModel('OrganizationEvents');
        $this->loadModel('PostComments');
        $this->loadModel('PostCommentContents');

        $organization_event_id = $this->request->data('organization_event_id');
        $post_id = $this->OrganizationEvents->find('all')->where(['OrganizationEvents.organization_event_id' => $organization_event_id])->first()->event_post_id;

        $currentUser = $this->Auth->user('id');

        $userActivity = $this->UserActivities->newEntity();
        $userPostActivity = $this->UserPostActivities->newEntity();
        $postComment = $this->PostComments->newEntity();
        $postCommentContent = $this->PostCommentContents->newEntity();

        if ($this->request->is(['post','put'])) {

            # begin save UserActivities

            $userActivity->user_activity_activity_type_id = 1; # posts
            $userActivity->user_activity_user_id = $currentUser;
            $userActivity->user_activity_post_id = $post_id;

            if ($activityID = $this->UserActivities->save($userActivity)) {

                # begin save UserPostActivities

                $userPostActivity->user_post_activity_user_id = $currentUser;
                $userPostActivity->user_post_activity_type_id = 2; # comment
                $userPostActivity->user_post_activity_post_id = $post_id;
                $userPostActivity->user_post_activities_user_activity_id = $activityID->user_activity_id;

                if ($postActivityID = $this->UserPostActivities->save($userPostActivity)) {

                    # begin save PostComments
                    $this->log('error: ' . $activityID->user_activity_id,'debug');

                    $postComment->post_comment_user_id = $currentUser;
                    $postComment->post_comment_post_id = $post_id;
                    $postComment->post_comment_post_activity_id = $postActivityID->user_post_activity_id;
                    $postComment->post_comment_activity_id = $activityID->user_activity_id;

                    if ($postCommentID = $this->PostComments->save($postComment)) {

                        # begin save PostCommentContents

                        $postCommentContent->post_comment_content = $this->request->data('comment');
                        $postCommentContent->post_comment_content_post_comment_id = $postCommentID->post_comment_id;

                        if ($this->PostCommentContents->save($postCommentContent)) {

                        }
                        else {
                            $this->log($postCommentContent->errors(),'debug');
                        }
                        # end save PostCommentContents
                    }
                    else {
                        $this->log($postComment->errors(),'debug');
                    }
                    # end save PostComments
                }
                else {
                    $this->log($userPostActivity->errors(),'debug');
                }
                # end save UserPostActivities
            }
            else {
                $this->log($userActivity->errors(),'debug');
            }
            # end save UserActivities
        }
        # end post put
    }

    public function announcementView($organization_announcement_id) {

        $currentUser = $this->Auth->user('id');

        $this->loadModel('OrganizationAnnouncements');
        $this->loadModel('UserPostReactions');
        $this->loadModel('PostReactions');
        $this->loadModel('PostComments');
        $this->loadModel('PostCommentContents');
        $this->loadModel('Users');
        $this->loadModel('UserProfiles');

        $organization_announcement = $this->OrganizationAnnouncements->find('all')->where(['OrganizationAnnouncements.organization_announcement_id'=> $organization_announcement_id])->first();
        $post_id = $organization_announcement->announcement_post_id;

        $this->title('PUPQC | ' . $organization_announcement->organization_announcement_title);


        $getCurrentReaction = $this->UserPostReactions->find('all')->where(['UserPostReactions.user_post_reaction_user_id' => $currentUser])->where(['UserPostReactions.user_post_reaction_post_id' => $post_id]);
        $currentReaction = '';
        $getReactionsCountAvailable = false;

        $getReactionsCount = $this->PostReactions->find('all')->where(['PostReactions.post_reactions_post_id' => $post_id]);

        if ($getReactionsCount->count() > 0) {
            $getReactionsCountAvailable = true;
            $getReactionsCount = $getReactionsCount->first();
        }

        if ($getCurrentReaction->count() > 0) {
            if ($getCurrentReaction->first()->user_post_reaction_like == true) {
                $currentReaction = 'Like';
            }
            else if ($getCurrentReaction->first()->user_post_reaction_dislike == true) {
                $currentReaction = 'Dislike';
            }
        }

        $postCommentContents = $this->paginate($this->PostCommentContents->find('all')->contain(['PostComments','PostComments.Users.UserProfiles'])->where(['PostComments.post_comment_post_id' => $post_id]));
        $this->set(compact('postCommentContents'));

        $this->set('organization_announcement', $organization_announcement);
        $this->set('organization_announcement_id', $organization_announcement_id);
        $this->set('currentReaction', $currentReaction);
        $this->set('reactions', $getReactionsCount);
        $this->set('getReactionsCountAvailable', $getReactionsCountAvailable);
        $this->log('current: ' . $currentReaction,'debug');
    }

    public function saveAnnouncementPostReactions() {

        $this->layout = false; 
        $this->autoRender = false;

        $this->loadModel('UserActivities');
        $this->loadModel('UserPostActivities');
        $this->loadModel('UserPostReactions');
        $this->loadModel('PostReactions');
        $this->loadModel('OrganizationAnnouncements');

        $organization_announcement_id = $this->request->data('organization_announcement_id');
        $post_id = $this->OrganizationAnnouncements->find('all')->where(['OrganizationAnnouncements.organization_announcement_id' => $organization_announcement_id])->first()->announcement_post_id;

        $currentUser = $this->Auth->user('id');

        $userActivity = $this->UserActivities->newEntity();
        $userPostActivity = $this->UserPostActivities->newEntity();
        $userPostReactions = $this->UserPostReactions->newEntity();
        $postReactions = $this->PostReactions->newEntity();

        if ($this->request->is(['post','put'])) {

            $userActivity->user_activity_activity_type_id = 1;
            $userActivity->user_activity_user_id = $currentUser;
            $userActivity->user_activity_post_id = $post_id;

            if($activityID = $this->UserActivities->save($userActivity)) {

                $userPostActivity->user_post_activity_user_id = $currentUser;
                $userPostActivity->user_post_activity_type_id = 3;
                $userPostActivity->user_post_activity_post_id = $post_id;
                $userPostActivity->user_post_activities_user_activity_id = $activityID->user_activity_id;

                if ($postActivityID = $this->UserPostActivities->save($userPostActivity)) {

                    $reaction = $this->request->data('reaction');
                    $this->log('reaction: ' . $reaction,'debug');

                    // begin save UserPostReactions
                    $checkIfUserPostReactionRowExists = $this->UserPostReactions->find('all')->where(['UserPostReactions.user_post_reaction_user_id' => $currentUser])->where(['UserPostReactions.user_post_reaction_post_id' => $post_id]);

                    if (!$checkIfUserPostReactionRowExists->isEmpty()) {
                        $user_post_reactions_id = $checkIfUserPostReactionRowExists->first()->user_post_reactions_id;
                        $userPostReactionsTable = TableRegistry::get('UserPostReactions');
                        $userPostReactionsTable = TableRegistry::getTableLocator()->get('UserPostReactions');
                        $userPostReaction = $userPostReactionsTable->get($user_post_reactions_id);

                        if ($reaction == 'Like') {
                            $userPostReaction->user_post_reaction_like = true;
                        }
                        else if ($reaction == 'LikeCancelDislike') {
                            $userPostReaction->user_post_reaction_like = true;
                            $userPostReaction->user_post_reaction_dislike = false;
                        }
                        else if ($reaction == 'LikeCancel') {
                            $userPostReaction->user_post_reaction_like = false;
                        }
                        else if ($reaction == 'Dislike') {
                            $userPostReaction->user_post_reaction_dislike = true;
                        }
                        else if ($reaction == 'DislikeCancelLike') {
                            $userPostReaction->user_post_reaction_dislike = true;
                            $userPostReaction->user_post_reaction_like = false;
                        }
                        else if ($reaction == 'DislikeCancel') {
                            $userPostReaction->user_post_reaction_dislike = false;
                        }

                        $userPostReaction->user_post_reaction_post_id = $post_id;
                        $userPostReaction->user_post_reaction_user_id = $currentUser;
                        $userPostReaction->user_post_reaction_post_activity_id = $postActivityID->user_post_activity_id;
                        $userPostReaction->user_post_reactions_activity_id = $activityID->user_activity_id;
                        if ($userPostReactionsTable->save($userPostReaction)) {

                        }
                        else {
                            $this->log($userPostReaction->errors,'debug');
                        }
                    }
                    else {

                        if ($reaction == 'Like') {
                            $userPostReactions->user_post_reaction_like = true;
                            $userPostReactions->user_post_reaction_dislike = false;
                        }
                        else if ($reaction == 'Dislike') {
                            $userPostReactions->user_post_reaction_dislike = true;
                            $userPostReactions->user_post_reaction_like = false;
                        }

                        $userPostReactions->user_post_reaction_post_id = $post_id;
                        $userPostReactions->user_post_reaction_user_id = $currentUser;
                        $userPostReactions->user_post_reaction_post_activity_id = $postActivityID->user_post_activity_id;
                        $userPostReactions->user_post_reactions_activity_id = $activityID->user_activity_id;

                        if ($this->UserPostReactions->save($userPostReactions)) {
                        }
                        else {
                            $this->log($userPostReactions->errors,'debug');
                        }
                    }
                    // end save UserPostReactions

                    // begin save PostReactions
                    $checkIfPostReactionRowExists = $this->PostReactions->find('all')->where(['PostReactions.post_reactions_post_id' => $post_id]);

                    if (!$checkIfPostReactionRowExists->isEmpty()) {

                        $post_reactions_id = $checkIfPostReactionRowExists->first()->post_reactions_id;
                        $postReactionsTable = TableRegistry::get('PostReactions');
                        $postReactionsTable = TableRegistry::getTableLocator()->get('PostReactions');
                        $postReaction = $postReactionsTable->get($post_reactions_id);

                        if ($reaction == 'Like') {
                            $postReaction->post_likes_count += 1;
                        }
                        else if ($reaction == 'LikeCancelDislike') {
                            $postReaction->post_likes_count += 1;
                            $postReaction->post_dislikes_count -= 1;
                        }
                        else if ($reaction == 'LikeCancel') {
                            $postReaction->post_likes_count -= 1;
                        }
                        else if ($reaction == 'Dislike') {
                            $postReaction->post_dislikes_count += 1;
                        }
                        else if ($reaction == 'DislikeCancelLike') {
                            $postReaction->post_dislikes_count += 1;
                            $postReaction->post_likes_count -= 1;
                        }
                        else if ($reaction == 'DislikeCancel') {
                            $postReaction->post_dislikes_count -= 1;
                        }
                        $postReaction->post_reactions_post_id = $post_id;

                        if ($getpostReactionsID = $postReactionsTable->save($postReaction)) {
                            
                        }
                        else {
                             $this->log($postReaction->errors,'debug');
                        }
                    }
                    else {
                        if ($reaction == 'Like') {
                            $postReactions->post_likes_count += 1;
                        }
                        else if ($reaction == 'Dislike') {
                            $postReactions->post_dislikes_count += 1;
                        }
                            
                        $postReactions->post_reactions_post_id = $post_id;
                        if ($this->PostReactions->save($postReactions)) {
                            $this->log('Success User Post on else','debug');
                        }
                        else {
                            $this->log($postReaction->errors,'debug');
                        }
                    }
                    // end save UserPostReactions
                }
            }
            // end saving data
        }
        // end post/put
    }

    public function saveAnnouncementPostComments() 
    {
        $this->layout = false; 
        $this->autoRender = false;

        $this->loadModel('UserActivities');
        $this->loadModel('UserPostActivities');
        $this->loadModel('OrganizationAnnouncements');
        $this->loadModel('PostComments');
        $this->loadModel('PostCommentContents');

        $organization_announcement_id = $this->request->data('organization_announcement_id');
        $post_id = $this->OrganizationAnnouncements->find('all')->where(['OrganizationAnnouncements.organization_announcement_id' => $organization_announcement_id])->first()->announcement_post_id;

        $currentUser = $this->Auth->user('id');

        $userActivity = $this->UserActivities->newEntity();
        $userPostActivity = $this->UserPostActivities->newEntity();
        $postComment = $this->PostComments->newEntity();
        $postCommentContent = $this->PostCommentContents->newEntity();

        if ($this->request->is(['post','put'])) {

            $userActivity->user_activity_activity_type_id = 1;
            $userActivity->user_activity_user_id = $currentUser;
            $userActivity->user_activity_post_id = $post_id;

            if ($activityID = $this->UserActivities->save($userActivity)) {

                $userPostActivity->user_post_activity_user_id = $currentUser;
                $userPostActivity->user_post_activity_type_id = 2;
                $userPostActivity->user_post_activity_post_id = $post_id;
                $userPostActivity->user_post_activities_user_activity_id = $activityID->user_activity_id;

                if ($postActivityID = $this->UserPostActivities->save($userPostActivity)) {

                    $postComment->post_comment_user_id = $currentUser;
                    $postComment->post_comment_post_id = $post_id;
                    $postComment->post_comment_post_activity_id = $postActivityID->user_post_activity_id;
                    $postComment->post_comment_activity_id = $activityID->user_activity_id;

                    if ($postCommentID = $this->PostComments->save($postComment)) {

                        $postCommentContent->post_comment_content = $this->request->data('comment');
                        $postCommentContent->post_comment_content_post_comment_id = $postCommentID->post_comment_id;

                        if ($this->PostCommentContents->save($postCommentContent)) {

                        }
                        else {
                            $this->log($postCommentContent,'debug');
                        }
                    }
                    else {
                        $this->log($postComment,'debug');
                    }
                }
                else {
                    $this->log($userPostActivity,'debug');
                }
            }
            else {
                $this->log($userActivity,'debug');
            }
        }
    }


    public function tags()
    {
        // The 'pass' key is provided by CakePHP and contains all
        // the passed URL path segments in the request.
        $tags = $this->request->getParam('pass');

        // Use the ArticlesTable to find tagged articles.
        $articles = $this->Articles->find('tagged', [
            'tags' => $tags
        ]);

        // Pass variables into the view template context.
        $this->set([
            'articles' => $articles,
            'tags' => $tags
        ]);
    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        // The add and tags actions are always allowed to logged in users.
        if (in_array($action, ['add', 'tags','index','view','saveEventPostReactions','saveEventPostComment','announcementView','saveAnnouncementPostReactions','saveAnnouncementPostComments'])) {
            return true;
        }

    }

}