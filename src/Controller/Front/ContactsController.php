<?php
// src/Controller/Front/ContactsController.php

namespace App\Controller\Front;

use App\Controller\AppController;
class ContactsController extends AppController
{

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); 
        $this->navBar('abouts');
        $this->checkLoginStatus();
    }

    public function index()
    {
        $this->title('PUPQC | Contacts');
        $this->loadModel('ContactEmails');
        $emails = $this->ContactEmails->find('all')->where(['ContactEmails.active' => 1]);
        $emails = $this->Paginator->paginate($emails);
        $this->set(compact('emails'));

        $this->loadModel('ContactNumbers');
        $numbers = $this->ContactNumbers->find('all')->where(['ContactNumbers.active' => 1]);
        $numbers = $this->Paginator->paginate($numbers);
        $this->set(compact('numbers'));
    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        // The add and tags actions are always allowed to logged in users.
        if (in_array($action, ['add', 'edit','index'])) {
            return true;
        }
    }

}