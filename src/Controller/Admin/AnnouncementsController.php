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
        $this->adminSideBarHasSub('announcements');
        $this->adminSideBar('');
    }

    public function index()
    {
        $this->adminSideBar('all');
        $announcements = $this->Paginator->paginate($this->Announcements->find('all')->where(['Announcements.active' => 1]));
        $this->set(compact('announcements'));
    }

    public function add()
    {
        $this->adminSideBar('add');
        $announcement = $this->Announcements->newEntity();

        if ($this->request->is('post')) {
            $announcement = $this->Announcements->patchEntity($announcement, $this->request->getData());

            $announcement->announcement_title = $this->request->getData('announcement_title');
            $announcement->announcement_body = $this->request->getData('announcement_body');
            $announcement->active = 1;

            if ($saved = $this->Announcements->save($announcement)) {
                $this->Flash->success('Announcement Added!', [
                    'params' => [
                        'saves' => 'Announcement Added!'
                        ]
                    ]);
                return $this->redirect(['action' => 'index']);
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
        $this->adminSideBar('New Announcement');
        $announcement = $this->Announcements->find('all', 
                   array('conditions'=>array('Announcements.announcement_id'=>$announcement_id)));

        $row = $announcement->first();
        
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
        if (in_array($action, ['add', 'index','edit','delete'])) {
            return true;
        }
    }

}