<?php
// src/Controller/AdminController.php

namespace App\Controller\Front;

use App\Controller\AppController;
use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\Mailer\Email;
use App\Form\EmailForm;
use Cake\ORM\TableRegistry;

class EventsController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
        $this->Auth->allow(['index']);
        $this->navBar('events');
        $this->checkLoginStatus();
        // $this->updateEventStatus(); # uncomment

    }

    public function index($event_status)
    {
        $this->title('PUPQC | Events');
        $this->loadModel('Events');

        if ($this->request->is(['post', 'put'])) {
            $event_status = $this->request->getData('event_status');
            return $this->redirect(['action' => 'index', $event_status]);            
        }

        if ($event_status == 'all' || $event_status == 'All') {
            $events = $this->paginate($this->Events->find('all', array(
        'order'=>array('FIELD(Events.event_status,"Ongoing","Upcoming","Past") ASC')))->where(['Events.active' => 1,'Events.event_post_id  IS NOT' => null]));
        }
        else {
            $events = $this->paginate($this->Events->find('all', array('order'=>array('Events.event_end_date DESC')))->where(['Events.event_status' => $event_status])->where(['Events.active' => 1,'Events.event_post_id  IS NOT' => null]));
        }

        foreach ($events as $event) {
            $event->event_start_date = $event->event_start_date->format('l, F d, Y');
            $event->event_start_time = $event->event_start_time->format('g:i A');
            $event->event_end_date = $event->event_end_date->format('l, F d, Y');
            $event->event_end_time = $event->event_end_time->format('g:i A');
        }

        $this->set(compact('events'));
        $this->set('event_status', $event_status);
    }

    public function view($event_id)
	{
        $email = new EmailForm();
        $this->set('email', $email);

        $this->loadModel('Events');
        $this->loadModel('PostReactions');
        $this->loadModel('UserPostReactions');
        $this->loadModel('PostComments');
        $this->loadModel('PostCommentContents');

        $this->updateEventStatus();        
        $currentUser = $this->Auth->user('id');

        $event = $this->Events->find('all', 
                   array('conditions'=>array('Events.event_id'=>$event_id)));

        $this->title('PUPQC | ' . $event->first()->event_title);

        $row = $event->first();

        if ($row->active == 0) {
            return $this->redirect(['prefix' => 'front','controller' => 'home','action' => 'error404']);
        }
        else {

        $row->event_start_date = $row->event_start_date->format('l, F d, Y');
        $row->event_start_time = $row->event_start_time->format('g:i A');
        $row->event_end_date = $row->event_end_date->format('l, F d, Y');
        $row->event_end_time = $row->event_end_time->format('g:i A');

        $post_id = $event->first()->event_post_id;

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
        if ($this->request->is(['post', 'put'])) {
            $this->Events->patchEntity($event, $this->request->getData());
            if ($this->Events->save($event)) {
                $this->Flash->success(__('Your article has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your article.'));
        }

        $postCommentContents = $this->paginate($this->PostCommentContents->find('all')->contain(['PostComments','PostComments.Users.UserProfiles'])->where(['PostComments.post_comment_post_id' => $post_id]));
        $this->set(compact('postCommentContents'));

        $this->set('event', $event);
        $this->set('row', $row);
        $this->set('getReactionsCountAvailable', $getReactionsCountAvailable);
        $this->set('currentReaction', $currentReaction);
        $this->set('reactions', $getReactionsCount);
	}}

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


    public function filterStatus()
    {
        $this->loadModel('Events');
        $eventsFiltered = $this->Paginator->paginate($this->Events->find('all', array('order'=>array('Events.event_end_date DESC')))->where(['Events.event_status' => $event_status]));
        $this->set(compact('eventsFiltered'));

        $this->layout = false;
        $this->autoRender = false;

        if ($this->request->is(['post', 'put'])) {

            $event_status = $this->request->getData('event_status');

            $eventsTable = TableRegistry::get('Events');

            $eventsTable = TableRegistry::getTableLocator()->get('Events');
            $event = $eventsTable->get($event_id);

            $event->active = 0;

            if ($this->Events->save($event)) {
                $this->Flash->success('Event Deleted!', [
                    'params' => [
                        'saves' => 'Event Deleted!'
                        ]
                    ]);
            }
            else {
                debug($number->errors());
                $this->Flash->error(__('Unable to add your article.'));
            }
        }
    }

    public function sendMail($event_id) 
    {
        $this->layout = false;
        $this->autoRender = false;

        $email = new EmailForm();
        if ($this->request->is('post')) {
            $message = $this->request->data['message']; 
            $subject = $this->request->data['subject'];           
            $email = new Email();
            $email->transport('mail');
            $email->from([$this->request->data['email'] => $this->request->data['name']])
            ->to('pup.maroon.cake@gmail.com')
            ->subject(sprintf('Event Inquiry:  %s', $this->request->data['subject']))
            //->attachments($path) //Path of attachment file
            ->send($message);

            if ( $email->send() ) {
                $this->Flash->sent('Message Sent!');
                return $this->redirect(['action' => 'view', $event_id]);
            } 
            else {
                $this->Flash->sent('Unable to send mesaage!');
                return $this->redirect(['action' => 'view', $event_id]);
            }
        }

        $this->set('email', $email);

    }

    public function savePostReactions() {

        $this->layout = false; 
        $this->autoRender = false;

        $this->loadModel('UserActivities');
        $this->loadModel('UserPostActivities');
        $this->loadModel('UserPostReactions');
        $this->loadModel('PostReactions');
        $this->loadModel('Events');

        $event_id = $this->request->data('event_id');
        $event = $this->Events->find('all')->where(['Events.event_id' => $event_id])->first()->event_post_id;

        $currentUser = $this->Auth->user('id');

        $userActivity = $this->UserActivities->newEntity();
        $userPostActivity = $this->UserPostActivities->newEntity();
        $userPostReactions = $this->UserPostReactions->newEntity();

        if ($this->request->is(['post','put'])) {

            $reaction = $this->request->data('reaction');

            $userActivity->user_activity_activity_type_id = 1; # posts
            $userActivity->user_activity_user_id = $currentUser;
            $userActivity->user_activity_post_id = $event;

            if ($activityID = $this->UserActivities->save($userActivity)) {

                if ($reaction == 'Like' || $reaction == 'LikeCancelDislike') {
                    $user_post_activity_type_id = 3;
                }
                else if ($reaction == 'Dislike' || $reaction == 'DislikeCancelLike') {
                    $user_post_activity_type_id = 4;
                }
                else if ($reaction == 'LikeCancel') {
                    $user_post_activity_type_id = 5;
                }
                else if ($reaction == 'DislikeCancel') {
                    $user_post_activity_type_id = 6;
                }

                $userPostActivity->user_post_activity_user_id = $currentUser;
                $userPostActivity->user_post_activity_type_id = $user_post_activity_type_id; 
                $userPostActivity->user_post_activity_post_id = $event;
                $userPostActivity->user_post_activities_user_activity_id = $activityID->user_activity_id;

                if ($postActivityID = $this->UserPostActivities->save($userPostActivity)) {


                    // begin save UserPostReactions

                    $checkIfUserPostReactionRowExists = $this->UserPostReactions->find('all')->where(['UserPostReactions.user_post_reaction_user_id' => $currentUser])->where(['UserPostReactions.user_post_reaction_post_id' => $event]);

                    
                    if (!$checkIfUserPostReactionRowExists->isEmpty()) {

                        $user_post_reactions_id = $checkIfUserPostReactionRowExists->first()->user_post_reactions_id;

                        $userPostReactionsTable = TableRegistry::get('UserPostReactions');
                        $userPostReactionsTable = TableRegistry::getTableLocator()->get('UserPostReactions');
                        $userPostReaction = $userPostReactionsTable->get($user_post_reactions_id);

                        $this->log('react' . $reaction,'debug');
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

                        $userPostReaction->user_post_reaction_post_id = $event;
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

                        $userPostReactions->user_post_reaction_post_id = $event;
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
                    $checkIfPostReactionRowExists = $this->PostReactions->find('all')->where(['PostReactions.post_reactions_post_id' => $event]);

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

                        $postReaction->post_reactions_post_id = $event;
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
                            
                        $postReactions->post_reactions_post_id = $event;
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


    public function savePostComment() 
    {
        $this->layout = false; 
        $this->autoRender = false;

        $this->loadModel('UserActivities');
        $this->loadModel('UserPostActivities');
        $this->loadModel('Events');
        $this->loadModel('PostComments');
        $this->loadModel('PostCommentContents');

        $event_id = $this->request->data('event_id');
        $post_id = $this->Events->find('all')->where(['Events.event_id' => $event_id])->first()->event_post_id;

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

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        // The add and tags actions are always allowed to logged in users.
        if (in_array($action, ['add', 'tags','index','view','sendMail','savePostReactions','savePostComment'])) {
            return true;
        }

    }

}