<?php
// src/Controller/AdminController.php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;


class AnnouncementsController extends AppController
{
    public function sideBar() {

        $this->loadModel('Users');
        $users =  $this->Users->find('all')->where(['Users.id' => $this->Auth->user('id')]);
        $users = $users->first(); 
        $this->set(compact('users', $users));
        $this->log($users->email,'debug');
    }
    
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
        $this->sideBar();
        $this->adminSideBarHasSub('posts');
        $this->adminHeaderSideBar('announcements');
    }

    public function index()
    {
        $this->title('Admin | Announcements');

        $announcements = $this->Paginator->paginate($this->Announcements->find('all')->where(['Announcements.active' => 1]));
        $this->set(compact('announcements'));
    }

    public function announcementAdd()
    {
        $this->title('Admin | Add Announcement');

        $this->loadModel('Posts');
        $this->loadModel('UserActivities');
        $this->loadModel('UserPostActivities');
        $this->loadModel('PostReactions');

        $currentUser = $this->Auth->user('id');

        $announcement = $this->Announcements->newEntity();
        $post = $this->Posts->newEntity();
        $userActivity = $this->UserActivities->newEntity();
        $userPostActivity = $this->UserPostActivities->newEntity();
        $postReactions = $this->PostReactions->newEntity();

        if ($this->request->is('post')) {
            $announcement = $this->Announcements->patchEntity($announcement, $this->request->getData());

            $post->post_user_id = $currentUser;
            $post->post_post_type_id = 1;
            $post->post_active = 1;

            $userActivity->user_activity_activity_type_id = 1;
            $userActivity->user_activity_user_id = $currentUser;

            $userPostActivity->user_post_activity_user_id = $currentUser;
            $userPostActivity->user_post_activity_type_id = 1;

            $postReactions->post_comments_count = 0;
            $postReactions->post_likes_count = 0;
            $postReactions->post_dislikes_count = 0;

            $announcement->announcement_title = $this->request->getData('announcement_title');
            $announcement->announcement_body = $this->request->getData('announcement_body');
            $announcement->active = 1;

            if ($postID = $this->Posts->save($post)) {
                $userActivity->user_activity_reference_no = $postID->post_id;
                if ($this->UserActivities->save($userActivity)) {
                    $userPostActivity->user_post_activity_post_id = $postID->post_id;
                    if ($this->UserPostActivities->save($userPostActivity)) {
                        $postReactions->post_reactions_post_id = $postID->post_id;
                        if ($this->PostReactions->save($postReactions)) {
                            $announcement->announcement_post_id = $postID->post_id;
                            if ($this->Announcements->save($announcement)) {

                                $this->Flash->success('Announcement Added!', [
                                    'params' => [
                                        'saves' => 'Announcement Added!'
                                    ]
                                ]);
                                return $this->redirect(['action' => 'index']);
                            }
                        }
                    }
                }
            }
            else {
                debug($announcement->errors("?"));
                $this->Flash->error(__('Unable to add announcement'));  
            }
            
        }
        // Get a list of tags.

        $this->set('announcement', $announcement);
    }
    
    
    public function edit($announcement_id)
    {
        $announcement = $this->Announcements->find('all', 
                   array('conditions'=>array('Announcements.announcement_id'=>$announcement_id)));
        $row = $announcement->first();

        $this->title('Edit Announcement | ' . $row->announcement_title);

        
        if ($this->request->is(['post', 'put'])) {

            $announcementsTable = TableRegistry::get('Announcements');

            $announcementsTable = TableRegistry::getTableLocator()->get('Announcements');
            $announcement = $announcementsTable->get($announcement_id);

            $announcement->announcement_title = $this->request->data['announcement_title'];
            $announcement->announcement_body = $this->request->data['announcement_body'];
            $announcement->announcement_modified = Time::now();;

            if ($announcementsTable->save($announcement)) {
                $this->Flash->success('Announcement Updated!', [
                    'params' => [
                        'saves' => 'Announcement Updated!'
                        ]
                    ]);
                return $this->redirect(['action' => 'index']);
            }
            else {
                $this->Flash->error(__('Unable to edit announcement'));  
            }
            
        }

        $this->set('announcement', $announcement);
        $this->set('row', $row);
    }

    public function delete()
    {   
        $this->layout = false;
        $this->autoRender = false;

        if ($this->request->is(['post', 'put'])) {

            $announcement_id = $this->request->getData('announcement_id');

            $announcementsTable = TableRegistry::get('Announcements');

            $announcementsTable = TableRegistry::getTableLocator()->get('Announcements');
            $announcement = $announcementsTable->get($announcement_id);

            $announcement->active = 0;

            if ($this->Announcements->save($announcement)) {
                $this->Flash->success('Announcement Deleted!', [
                    'params' => [
                        'saves' => 'Announcement Deleted!'
                        ]
                    ]);
            }
            else {
                $this->Flash->error(__('Unable to delete announcement'));  
            }
            
        }
    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        // The add and tags actions are always allowed to logged in users.
        if (in_array($action, ['announcementAdd', 'index','edit','delete'])) {
            return true;
        }
    }

}