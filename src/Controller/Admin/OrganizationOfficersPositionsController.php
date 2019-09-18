<?php
// src/Controller/AdminController.php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class OrganizationOfficersPositionsController extends AppController
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
        $this->adminSideBarHasSub('settings');
        $this->adminSideBar('officers');
    }

    public function index()
    {   
        $organization_officers_positions = $this->Paginator->paginate($this->OrganizationOfficersPositions->find('all')->where(['OrganizationOfficersPositions.active' => 1])->order([
        'OrganizationOfficersPositions.officers_position_priority' => 'ASC'
        ]));
        $this->set(compact('organization_officers_positions'));
    }

    public function add()
    {
        $organization_officers_positions = $this->OrganizationOfficersPositions->newEntity();

        if ($this->request->is('post')) {


            $organization_officers_positions->officers_position_name = $this->request->getData('officers_position_name');
            $organization_officers_positions->officers_position_priority = $this->request->getData('officers_position_priority');
            $organization_officers_positions->active = 1;

            if ($saved = $this->OrganizationOfficersPositions->save($organization_officers_positions)) {
                $this->Flash->success('Officer Position Added!', [
                    'params' => [
                        'saves' => 'Officer Position Added!!'
                        ]
                    ]);
                return $this->redirect(['action' => 'index']);
            }
            else {
                $this->Flash->error(__('Unable to add your article.'));
            }
        }
        $this->set('organization_officers_positions', $organization_officers_positions);
    }
    
    public function edit($officers_position_id)
    {
        $organization_officers_positions = $this->OrganizationOfficersPositions->find('all', 
                   array('conditions'=>array('OrganizationOfficersPositions.officers_position_id'=>$officers_position_id)));
        $row = $organization_officers_positions->first();

        if ($this->request->is(['post', 'put'])) {

            $organizationsTable = TableRegistry::get('OrganizationOfficersPositions');

            $organizationOfficersPositionsTable = TableRegistry::getTableLocator()->get('OrganizationOfficersPositions');
            $organization_officers_positions = $organizationOfficersPositionsTable->get($officers_position_id);

            $organization_officers_positions->officers_position_name = $this->request->data['officers_position_name'];
            $organization_officers_positions->officers_position_priority = $this->request->data['officers_position_priority'];

            if ($organizationOfficersPositionsTable->save($organization_officers_positions)) {
                $this->Flash->success('Officer Position Updated!', [
                    'params' => [
                        'saves' => 'Officer Position Updated!!'
                        ]
                    ]);
                return $this->redirect(['action' => 'index']);
            }
            else {
                $this->Flash->error(__('Unable to update your article.'));
            }
        }

        $this->set('organization_officers_positions', $organization_officers_positions);
        $this->set('row', $row);
    }

    public function delete()
    {   
        $this->layout = false;
        $this->autoRender = false;

        if ($this->request->is(['post', 'put'])) {

            $officers_position_id = $this->request->getData('officers_position_id');

            $organizationOfficersPositionsTable = TableRegistry::get('OrganizationOfficersPositions');

            $organizationOfficersPositionsTable = TableRegistry::getTableLocator()->get('OrganizationOfficersPositions');
            $officer_position = $organizationOfficersPositionsTable->get($officers_position_id);

            $officer_position->active = 0;

            if ($this->OrganizationOfficersPositions->save($officer_position)) {
                $this->Flash->success('Employee Position Deleted!', [
                    'params' => [
                        'saves' => 'Employee Position Deleted!!'
                        ]
                    ]);
            }
            else {

                debug($officer_position->errors("?"));
                $this->log($officer_position->error,'debug');
                $this->Flash->error(__('Unable to add your article.'));
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