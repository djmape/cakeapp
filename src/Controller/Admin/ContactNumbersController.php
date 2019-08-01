<?php
// src/Controller/ContactNumbersController.php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class ContactNumbersController extends AppController
{
    #public $helpers = array('TinyMCE.TinyMCE');
    
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
        $this->loadComponent('Flash');
        $this->sideBar();
        $this->adminSideBarHasSub('contacts');
        $this->adminSideBar('numbers');
    }

    public function index()
    {
        $numbers = $this->ContactNumbers->find('all')->where(['ContactNumbers.active' => 1]);
        $numbers = $this->Paginator->paginate($numbers);
        $this->set(compact('numbers'));
    }

    public function add()
    {        
        $number = $this->ContactNumbers->newEntity();
        if ($this->request->is('post')) {

            $number->contact_number = $this->request->data['contact_number'];
            $number->active = 1;

            if ($saved = $this->ContactNumbers->save($number)) {
                $this->Flash->success('Contact Number Added!', [
                    'params' => [
                        'saves' => 'Contact Number Added!!'
                        ]
                    ]);
                return $this->redirect(['action' => 'edit', $saved->contact_number_id]);
            }
            else {
                debug($number->errors());
            $this->Flash->error(__('Unable to add your article.'));
            }
            
        }

        $this->set('number', $number);
    }

    public function edit($contact_number_id)
    {
        $numbers = $this->ContactNumbers->find('all', 
                   array('conditions'=>array('ContactNumbers.contact_number_id'=>$contact_number_id)));

        $numbers = $numbers->first();

        $this->set('numbers', $numbers);

        if ($this->request->is(['post', 'put'])) {

            $numbersTable = TableRegistry::get('ContactNumbers');

            $numbersTable = TableRegistry::getTableLocator()->get('ContactNumbers');
            $number = $numbersTable->get($contact_number_id);

            $number->contact_number = $this->request->data['contact_number'];

            if ($numbersTable->save($number)) {
                $this->Flash->success('Contact Number Updated!', [
                    'params' => [
                        'saves' => 'Contact Number Updated!!'
                        ]
                    ]);
                return $this->redirect(['action' => 'edit', $contact_number_id]);
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

            $contact_number_id = $this->request->getData('contact_number_id');

            $numbersTable = TableRegistry::get('ContactNumbers');

            $numbersTable = TableRegistry::getTableLocator()->get('ContactNumbers');
            $number = $numbersTable->get($contact_number_id);

            $number->active = 0;

            if ($saved = $this->ContactNumbers->save($number)) {
            	$this->Flash->success('Contact Number Removed!', [
                    'params' => [
                    	'saves' => 'Contact Number Removed!!'
                    	]
                    ]);
            }
            else {
                debug($number->errors());
                $this->Flash->error(__('Unable to add your article.'));
            }
            
        }
    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        // The add and tags actions are always allowed to logged in users.
        if (in_array($action, ['index','add','edit','delete'])) {
            return true;
        }

    }

}