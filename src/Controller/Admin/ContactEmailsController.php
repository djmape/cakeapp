<?php
// src/Controller/Admin/ContactEmailsController.php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class ContactEmailsController extends AppController
{

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
        $this->adminHeaderSidebar('email');
        $this->adminSideBarHasSub('site-info');
        $this->title('Admin | Emails');
    }

    public function index()
    {
        $emails = $this->ContactEmails->find('all')->where(['ContactEmails.active' => 1]);
        $emails = $this->Paginator->paginate($emails);
        $this->set(compact('emails'));
    }

    public function add()
    {      

        $this->layout = false;
        $this->autoRender = false;

        $email = $this->ContactEmails->newEntity();

        if ($this->request->is('post')) {

            $email->contact_email = $this->request->getData('email');
            $email->active = 1;

            if ($saved = $this->ContactEmails->save($email)) {
                $this->Flash->success('Email Added!', [
                    'params' => [
                        'saves' => 'Email Added!'
                        ]
                    ]);
            }
            else {
                debug($email->errors());
                $this->Flash->error(__('Unable to add your article.'));
            }
            
        }
        $this->set('email', $email);
    }
    
    public function edit()
    {        

        $this->layout = false;
        $this->autoRender = false;

        $contact_email_id = $this->request->getData('contact_email_id');

        if ($this->request->is(['post', 'put'])) {

            $emailsTable = TableRegistry::get('ContactEmails');

            $emailsTable = TableRegistry::getTableLocator()->get('ContactEmails');
            $email = $emailsTable->get($contact_email_id);

            $email->contact_email = $this->request->getData('email');

            if ($emailsTable->save($email)) {
                $this->Flash->success('Email Updated!', [
                    'params' => [
                        'saves' => 'Email Updated!'
                        ]
                    ]);
            }
            else {
                $this->Flash->error(__('Unable to add your article.'));
            }
            
        }

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