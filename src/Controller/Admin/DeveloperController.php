<?php
// src/Controller/AdminController.php

namespace App\Controller\Admin;

use App\Controller\AppController;

class DeveloperController extends AppController
{
    public function sideBar() {

        $this->loadModel('Users');
        $users =  $this->Users->find('all')->where(['Users.id' => $this->Auth->user('id')]);
        $users = $users->first(); 
        $this->set(compact('users', $users));
    }
    
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
        $this->Auth->allow(['tags']);
    }

    public function index()
    {

    }

    public function addUserType()
    {
        $this->loadModel("UserTypes");

        $user_type = $this->UserTypes->newEntity();

        if ($this->request->is('post')) {

            $user_type->user_type_name = $this->request->getData('user_type_name');

            if ($saved = $this->UserTypes->save($user_type)) {
                $this->Flash->success('User Type Added!', [
                    'params' => [
                        'saves' => 'User Type Added!'
                        ]
                    ]);
                return $this->redirect(['action' => 'addUserType']);
            }
            else {
                debug($user_type->errors());
            }
            
        }
        $this->set('user_type', $user_type);
    }

    public function addActivityType()
    {
        $this->loadModel("ActivityTypes");

        $activity_type = $this->ActivityTypes->newEntity();

        if ($this->request->is('post')) {

            $activity_type->activity_type_name = $this->request->getData('activity_type_name');

            if ($saved = $this->ActivityTypes->save($activity_type)) {
                $this->Flash->success('Activity Type Added!', [
                    'params' => [
                        'saves' => 'Activity Type Added!'
                        ]
                    ]);
                return $this->redirect(['action' => 'addActivityType']);
            }
            else {
                debug($activity_type->errors());
            }
            
        }
        $this->set('activity_type', $activity_type);
    }

    public function addPostType()
    {
        $this->loadModel("PostTypes");

        $post_type = $this->PostTypes->newEntity();

        if ($this->request->is('post')) {

            $post_type->post_type_name = $this->request->getData('post_type_name');

            if ($saved = $this->PostTypes->save($post_type)) {
                $this->Flash->success('Post Type Added!', [
                    'params' => [
                        'saves' => 'Post Type Added!'
                        ]
                    ]);
                return $this->redirect(['action' => 'addPostType']);
            }
            else {
                debug($post_type->errors());
            }
            
        }
        $this->set('post_type', $post_type);
    }

    public function addPostReactionType()
    {
        $this->loadModel("PostReactionTypes");

        $post_reaction_type = $this->PostReactionTypes->newEntity();

        if ($this->request->is('post')) {

            $post_reaction_type->post_reaction_type_name = $this->request->getData('post_reaction_type_name');

            if ($saved = $this->PostReactionTypes->save($post_reaction_type)) {
                $this->Flash->success('Post Reaction Type Added!', [
                    'params' => [
                        'saves' => 'Post Reaction Type Added!'
                        ]
                    ]);
                return $this->redirect(['action' => 'addPostReactionType']);
            }
            else {
                debug($post_reaction_type->errors());
            }
            
        }
        $this->set('post_reaction_type', $post_reaction_type);
    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        // The add and tags actions are always allowed to logged in users.
        if (in_array($action, ['index', 'addUserType','addActivityType','addPostType','addPostReactionType'])) {
            return true;
        }
    }
}