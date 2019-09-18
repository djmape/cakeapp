<?php
// src/Controller/AdminController.php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class ContactEmailsController extends AppController
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
        $this->sideBar();
        $this->adminSideBarHasSub('contacts');
        $this->adminSideBar('emails');
    }

    public function index()
    {
        $emails = $this->ContactEmails->find('all')->where(['ContactEmails.active' => 1]);
        $emails = $this->Paginator->paginate($emails);
        $this->set(compact('emails'));
    }

    public function view($slug = null)
	{
        $this->loadComponent('Paginator');
        $this->loadModel('Articles');
        $articles = $this->Paginator->paginate($this->Articles->find('all',array('order'=>array('Articles.created DESC')))->where(['Articles.status' => 1]));
        $this->set(compact('articles'));
	}

    public function add()
    {        
        $email = $this->ContactEmails->newEntity();
        if ($this->request->is('post')) {

            $email->contact_email = $this->request->data['contact_email'];
            $email->active = 1;

            if ($saved = $this->ContactEmails->save($email)) {
                $this->Flash->success('Email Added!', [
                    'params' => [
                        'saves' => 'Email Added!'
                        ]
                    ]);
                return $this->redirect(['action' => 'index']);
            }
            else {
                debug($email->errors());
                $this->Flash->error(__('Unable to add your article.'));
            }
            
        }

        $this->set('email', $email);
    }
    
    public function edit($contact_email_id)
    {        
        $emails = $this->ContactEmails->find('all', 
                   array('conditions'=>array('ContactEmails.contact_email_id'=>$contact_email_id)));

        $emails = $emails->first();

        $this->set('emails', $emails);

        if ($this->request->is(['post', 'put'])) {

            $emailsTable = TableRegistry::get('ContactEmails');

            $emailsTable = TableRegistry::getTableLocator()->get('ContactEmails');
            $email = $emailsTable->get($contact_email_id);

            $email->contact_email = $this->request->data['contact_email'];

            if ($emailsTable->save($email)) {
                $this->Flash->success('Email Updated!', [
                    'params' => [
                        'saves' => 'Email Updated!'
                        ]
                    ]);
                return $this->redirect(['action' => 'index']);
            }
            else {
                $this->Flash->error(__('Unable to add your article.'));
            }
            
        }
        // Get a list of tags.

    }
    
    public function delete()
    {   
        $this->layout = false;
        $this->autoRender = false;

        if ($this->request->is(['post', 'put'])) {

            $contact_email_id = $this->request->getData('contact_email_id');

            $emailsTable = TableRegistry::get('ContactEmails');

            $emailsTable = TableRegistry::getTableLocator()->get('ContactEmails');
            $email = $emailsTable->get($contact_email_id);

            $email->active = 0;

            if ($this->ContactEmails->save($email)) {
                $this->Flash->success('Contact Email Removed!', [
                    'params' => [
                        'saves' => 'Email Removed!'
                        ]
                    ]);
            }
            else {
                debug($email->errors());
            }
        }

    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        // The add and tags actions are always allowed to logged in users.
        if (in_array($action, ['add', 'edit','index','delete'])) {
            return true;
        }
    }
}