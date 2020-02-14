<?php
// src/Controller/AdminController.php

namespace App\Controller\Front;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class AnnouncementController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
        $this->Auth->allow(['index']);
        $this->navBar('announcements');
        $currentUser = $this->Auth->user('id');
        $this->loadComponent('RequestHandler');
        $this->checkLoginStatus();
    }

    public function index()
    {
        $this->title('PUPQC | All Announcements');
        $this->loadModel('Announcements');
        $this->set('announcements', $this->paginate($this->Announcements->find('all')->contain(['Posts'])->where(['Announcements.active' => 1])));
    }

    public function view($announcement_id)
	{
        $currentUser = $this->Auth->user('id');

        $this->loadModel('Announcements');
        $this->loadModel('UserPostReactions');
        $this->loadModel('PostReactions');
        $this->loadModel('PostComments');
        $this->loadModel('PostCommentContents');
        $this->loadModel('Users');
        $this->loadModel('UserProfiles');

        $announcement = $this->Announcements->find('all', 
                   array('conditions'=>array('Announcements.announcement_id'=>$announcement_id)));
        $post_id = $announcement->first()->announcement_post_id;

        $this->title('PUPQC | ' . $announcement->first()->announcement_title);

        $announcement = $announcement->first();

        if ($announcement->active == 0) {
            return $this->redirect(['prefix' => 'front','controller' => 'home','action' => 'error404']);
        }
        else {

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

        $this->log($currentReaction ,'debug');

        $postCommentContents = $this->paginate($this->PostCommentContents->find('all')->contain(['PostComments','PostComments.Users.UserProfiles'])->where(['PostComments.post_comment_post_id' => $post_id]));
        $this->set(compact('postCommentContents'));

        if ($this->request->is(['post', 'put'])) {
            $this->Announcements->patchEntity($announcement, $this->request->getData());
            if ($this->Announcements->save($announcement)) {
                $this->Flash->success(__('Your article has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your article.'));
        }

        $this->set('announcement', $announcement);
        $this->set('announcement_id', $announcement_id);
        $this->set('currentReaction', $currentReaction);
        $this->set('reactions', $getReactionsCount);
        $this->set('getReactionsCountAvailable', $getReactionsCountAvailable);
    }
	}


    public function savePostReactions() {

        $this->layout = false; 
        $this->autoRender = false;

        $this->loadModel('UserActivities');
        $this->loadModel('UserPostActivities');
        $this->loadModel('UserPostReactions');
        $this->loadModel('PostReactions');
        $this->loadModel('Announcements');

        $announcement_id = $this->request->data('announcement_id');
        $announcement = $this->Announcements->find('all')->where(['Announcements.announcement_id' => $announcement_id])->first()->announcement_post_id;

        $currentUser = $this->Auth->user('id');

        $userActivity = $this->UserActivities->newEntity();
        $userPostActivity = $this->UserPostActivities->newEntity();
        $userPostReactions = $this->UserPostReactions->newEntity();
        $postReactions = $this->PostReactions->newEntity();

        if ($this->request->is(['post','put'])) {

            $reaction = $this->request->data('reaction');

            $userActivity->user_activity_activity_type_id = 1;
            $userActivity->user_activity_user_id = $currentUser;
            $userActivity->user_activity_post_id = $announcement;

            if($activityID = $this->UserActivities->save($userActivity)) {

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
                $userPostActivity->user_post_activity_post_id = $announcement;
                $userPostActivity->user_post_activities_user_activity_id = $activityID->user_activity_id;

                if ($postActivityID = $this->UserPostActivities->save($userPostActivity)) {
                    
                    // begin save UserPostReactions
                    $checkIfUserPostReactionRowExists = $this->UserPostReactions->find('all')->where(['UserPostReactions.user_post_reaction_user_id' => $currentUser])->where(['UserPostReactions.user_post_reaction_post_id' => $announcement]);

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
                            $userPostReaction->user_post_reaction_like = false;
                        }
                        else if ($reaction == 'DislikeCancelLike') {
                            $userPostReaction->user_post_reaction_dislike = true;
                            $userPostReaction->user_post_reaction_like = false;
                        }
                        else if ($reaction == 'DislikeCancel') {
                            $userPostReaction->user_post_reaction_dislike = false;
                        }

                        $userPostReaction->user_post_reaction_post_id = $announcement;
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
                            $userPostReactions->user_post_reaction_dislike = false;
                        }
                        else if ($reaction == 'Dislike') {
                            $userPostReactions->user_post_reaction_dislike = true;
                            $userPostReactions->user_post_reaction_like = false;
                        }

                        $userPostReactions->user_post_reaction_post_id = $announcement;
                        $userPostReactions->user_post_reaction_user_id = $currentUser;
                        $userPostReactions->user_post_reaction_post_activity_id = $postActivityID->user_post_activity_id;
                        $userPostReactions->user_post_reactions_activity_id = $activityID->user_activity_id;

                        if ($this->UserPostReactions->save($userPostReactions)) {
                        }
                        else {

                        }
                    }
                    // end save UserPostReactions

                    // begin save PostReactions
                    $checkIfPostReactionRowExists = $this->PostReactions->find('all')->where(['PostReactions.post_reactions_post_id' => $announcement]);

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

                        $postReaction->post_reactions_post_id = $announcement;

                        if ($getpostReactionsID = $postReactionsTable->save($postReaction)) {
                            
                        }
                        else {

                        }
                    }
                    else {
                        if ($reaction == 'Like') {
                            $postReactions->post_likes_count += 1;
                        }
                        else if ($reaction == 'Dislike') {
                            $postReactions->post_dislikes_count += 1;
                        }
                            
                        $postReactions->post_reactions_post_id = $announcement;
                        if ($this->PostReactions->save($postReactions)) {
                            $this->log('Success User Post on else','debug');
                        }
                        else {

                        }
                    }
                    // end save UserPostReactions
                }
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
        $this->loadModel('Announcements');
        $this->loadModel('PostComments');
        $this->loadModel('PostCommentContents');

        $announcement_id = $this->request->data('announcement_id');
        $post_id = $this->Announcements->find('all')->where(['Announcements.announcement_id' => $announcement_id])->first()->announcement_post_id;

        $currentUser = $this->Auth->user('id');

        $userActivity = $this->UserActivities->newEntity();
        $userPostActivity = $this->UserPostActivities->newEntity();
        $postComment = $this->PostComments->newEntity();
        $postCommentContent = $this->PostCommentContents->newEntity();

        if ($this->request->is(['post','put'])) {

            $userActivity->user_activity_activity_type_id = 1;
            $userActivity->user_activity_user_id = $currentUser;
            $userActivity->user_activity_post_id = $post_id;

            if($activityID = $this->UserActivities->save($userActivity)) {

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
                    }
                }
            }
        }
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

    public function delete($slug)
    {
        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        if ($this->request->is(['post', 'put'])) {
            $article->status = 0;
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The {0} article has been deleted.', $article->title));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to delete your article.'));
        }
        $this->set('article', $article);
    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        // The add and tags actions are always allowed to logged in users.
        if (in_array($action, ['savePostReactions', 'getReactionsCount','index','savePostComment'])) {
            return true;
        }

    }

}