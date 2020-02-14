<?php
// src/Controller/AdminController.php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

class OrganizationsController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
        $this->adminSideBarHasSub('students');
        $this->adminHeaderSideBar('organizations');
        $this->header();
    }

    public function index()
    {        
        $this->title('Admin | Organizations');
        $organizations = $this->Paginator->paginate($this->Organizations->find('all')->where(['Organizations.active' => 1]));
        $this->set(compact('organizations'));
    }

    public function add()
    {   
        $this->title('Admin | Add Organization');
        $organization = $this->Organizations->newEntity();
        if ($this->request->is('post')) {
            if (!empty($this->request->data)) {
                if (!empty($this->request->data['organization_photo']['name'])) {
                    $file = $this->request->data['organization_photo']; //put the data into a var for easy use

                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                    $arr_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions
                    $setNewFileName = time() . "_" . rand(000000, 999999);

                    //only process if the extension is valid
                    if (in_array($ext, $arr_ext)) {
                        //do the actual uploading of the file. First arg is the tmp name, second arg is 
                        //where we are putting it
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/upload/' . $setNewFileName . '.' . $ext);

                        //prepare the filename for database entry 
                        $imageFileName = $setNewFileName . '.' . $ext;
                        }
                    }
                    else {
                        $imageFileName = '_default.jpg';
                    }

                $organization->organization_type = $this->request->data['organization_type'];
                $organization->organization_name = $this->request->data['organization_name'];
                $organization->organization_acronym = $this->request->data['organization_acronym'];
                $organization->organization_mission = $this->request->data['organization_mission'];
                $organization->organization_vision = $this->request->data['organization_vision'];
                $organization->organization_goal = $this->request->data['organization_goal'];
                $organization->organization_objective = $this->request->data['organization_objective'];
                $organization->organization_photo = $imageFileName;
                $organization->active = 1;
                
                    if (!empty($this->request->data['organization_photo']['name'])) {
                        $organization->organization_photo = $imageFileName;
                    }

            }

            $organization->organization_status = 1;

            if ($saved = $this->Organizations->save($organization)) {
                $this->Flash->success('Organization Added!', [
                    'params' => [
                        'saves' => 'Organization Added!'
                        ]
                    ]);
                return $this->redirect(['action' => 'index']);
            }
            else {
                debug($organization->errors());
            }
            
            $this->Flash->error(__('Unable to add your article.'));
        }
        // Get a list of tags.

        $this->set('organization', $organization);
    }
    
    public function edit($organization_id)
    {
        $this->title('Admin | Edit Organization');

        $organization = $this->Organizations->find('all', 
                   array('conditions'=>array('Organizations.organization_id'=>$organization_id)));

        $row = $organization->first();
        
        if ($this->request->is(['post', 'put'])) {
            if (!empty($this->request->data)) {
                if (!empty($this->request->data['organization_photo']['name'])) {
                    $file = $this->request->data['organization_photo']; //put the data into a var for easy use
                    
                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                    $arr_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions
                    $setNewFileName = time() . "_" . rand(000000, 999999);

                    //only process if the extension is valid
                    if (in_array($ext, $arr_ext)) {
                        //do the actual uploading of the file. First arg is the tmp name, second arg is 
                        //where we are putting it
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/upload/' . $setNewFileName . '.' . $ext);

                        //prepare the filename for database entry 
                        $imageFileName = $setNewFileName . '.' . $ext;
                        }
                    }
                    else {
                        $imageFileName = $row->organization_photo;
                    }

                $organizationsTable = TableRegistry::get('Organizations');

                $organizationsTable = TableRegistry::getTableLocator()->get('Organizations');
                $organization = $organizationsTable->get($organization_id);

                $organization->organization_type = $this->request->data['organization_type'];
                $organization->organization_name = $this->request->data['organization_name'];
                $organization->organization_acronym = $this->request->data['organization_acronym'];
                $organization->organization_mission = $this->request->data['organization_mission'];
                $organization->organization_vision = $this->request->data['organization_vision'];
                $organization->organization_goal = $this->request->data['organization_goal'];
                $organization->organization_objective = $this->request->data['organization_objective'];
                $organization->organization_photo = $imageFileName;

                    if (!empty($this->request->data['organization_photo']['name'])) {
                        $organization->organization_photo = $imageFileName;
                    }

            }

            if ($organizationsTable->save($organization)) {
                $this->Flash->success('Organization Updated!', [
                    'params' => [
                        'saves' => 'Organization Updated!'
                        ]
                    ]);
                return $this->redirect(['action' => 'index']);
            }
            else {
                $this->Flash->error(__('Unable to update organization.'));
            }
        }

        $this->set('organization', $organization);
        $this->set('row', $row);
    }

    public function delete()
    {   
        $this->layout = false;
        $this->autoRender = false;

        if ($this->request->is(['post', 'put'])) {

            $organization_id = $this->request->getData('organization_id');

            $organizationsTable = TableRegistry::get('Organizations');

            $organizationsTable = TableRegistry::getTableLocator()->get('Organizations');
            $organization = $organizationsTable->get($organization_id);

            $organization->active = 0;

            if ($this->Organizations->save($organization)) {
                $this->Flash->success('Organization Removed!', [
                    'params' => [
                        'saves' => 'Organization Removed!'
                        ]
                    ]);
            }
            else {
                $this->Flash->error(__('Unable to delete organization.'));
            }
            
        }
    }

    public function officers($organization_id)
    {   
        $organization =  $this->Organizations->find('all')->where(['Organizations.organization_id' => $organization_id]);
        $organization = $organization->first();
        $this->set('organization',$organization);

        $this->title('Admin | ' . $organization->organization_name);

        $this->loadModel('OrganizationOfficers');
        $organization_officers = $this->OrganizationOfficers->find('all')->contain(['OrganizationOfficersPositions' => ['sort' => ['OrganizationOfficersPositions.officers_position_priority' => 'DESC']],'Organizations'])->innerJoinWith('Organizations')->innerJoinWith('OrganizationOfficersPositions')->order([
        'OrganizationOfficersPositions.officers_position_priority' => 'ASC'
        ])->where(['Organizations.organization_id' => $organization_id])->where(['OrganizationOfficers.active' => 1]);
        $organization_officers = $this->paginate($organization_officers);
        $this->set(compact('organization_officers'));
    }

    public function addOfficer($organization_id)
    {
        $organization_officers_positions_count = 1;

        $this->loadModel('OrganizationOfficers');
        $this->loadModel('OrganizationOfficersPositions');
        $organization_officers_positions =  $this->OrganizationOfficersPositions->find('list', ['keyField' => 'officers_position_id', 'valueField' => 'officers_position_name'])->notMatching("OrganizationOfficers", 
                         function($q) use($organization_id) {
                            return $q->where(["OrganizationOfficers.active"=>1])->where(["OrganizationOfficers.organization_id"=>$organization_id]);
                         }
                      )->where(["OrganizationOfficersPositions.active"=>1]);
        if ($organization_officers_positions->count() == 0) {
            $this->log($organization_officers_positions->count(). ' zero','debug');
            $organization_officers_positions_count = 0;
        }
        else {
            $this->set('organization_officers_positions', $organization_officers_positions);
        }


        $this->loadModel('Organizations');
        $organization =  $this->Organizations->find('all')->where(['Organizations.organization_id' => $organization_id]);
        $this->set('organization', $organization->first());
        $this->title('Add Officer | ' . $organization->first()->organization_name);

        $organization_officer = $this->OrganizationOfficers->newEntity();

        $this->set('organization_officer', $organization_officer);

        $this->loadModel('Users');
        $this->loadModel("User_Types");
        $users = $this->Users->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row['user_lastname'] . ', ' . $row['user_firstname'] . ' ' . $row['user_middlename'];
            }
        ])->notMatching("OrganizationOfficers", 
                         function($q) use($organization_id) {
                            return $q->where(["OrganizationOfficers.active"=>1])->where(["OrganizationOfficers.organization_id"=>$organization_id]);
                         })
        ->where(['Users.active' => 1,'Users.user_lastname IS NOT' => null])->order([
        'Users.user_lastname' => 'ASC'
        ]);
        $this->log($users->count(),'debug');

        $users_count = 1;
        if ($users->count() == 0) {
            $users_count = 0;
        }
        else {
            $this->set('assignUsers', $users);
        }
        $this->set('users_count', $users_count);

        if ($this->request->is('post')) {
            if (!empty($this->request->data)) {
                $this->log('Got here', 'debug');
                if (!empty($this->request->data['officer_photo']['name'])) {
                    $this->log('Got here', 'debug');
                    $file = $this->request->data['officer_photo']; //put the data into a var for easy use

                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                    $arr_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions
                    $setNewFileName = time() . "_" . rand(000000, 999999);

                    //only process if the extension is valid
                    if (in_array($ext, $arr_ext)) {
                        //do the actual uploading of the file. First arg is the tmp name, second arg is 
                        //where we are putting it
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/upload/' . $setNewFileName . '.' . $ext);

                        //prepare the filename for database entry 
                        $imageFileName = $setNewFileName . '.' . $ext;
                        }
                    }
                    else {
                        $imageFileName = '_default.jpg';
                    }

                $organization_officer->organization_id = $organization_id;
                $organization_officer->officers_position_id = $this->request->data['officers_position_id'];
                $organization_officer->officer_lastname = $this->request->data['officer_lastname'];
                $organization_officer->officer_firstname = $this->request->data['officer_firstname'];
                $organization_officer->officer_middlename = $this->request->data['officer_middlename'];
                $organization_officer->officer_photo = $imageFileName;
                $organization_officer->active = 1;
            }

            if ($saved = $this->OrganizationOfficers->save($organization_officer)) {
                $this->Flash->success('Officer Added!', [
                    'params' => [
                        'saves' => 'Officer Added!'
                        ]
                    ]);
                return $this->redirect(['action' => 'officers', $organization_id]);
            }
            else {
                debug($employee->errors());
            $this->Flash->error(__('Unable to add your article.'));
            }
            
        }

        // checks if there are available positions
        $this->set('organization_officers_positions_count', $organization_officers_positions_count);

    }

    public function editOfficer($organization_officer_id,$organization_id)
    {
        $organization_officers_positions_count = 1;

        $this->loadModel('OrganizationOfficersPositions');
        $this->loadModel('OrganizationOfficers');
        $this->loadModel('Users');
        $organization_officers_positions =  $this->OrganizationOfficersPositions->find('list', ['keyField' => 'officers_position_id', 'valueField' => 'officers_position_name'])->notMatching("OrganizationOfficers", 
                         function($q) use($organization_id) {
                            return $q->where(["OrganizationOfficers.active"=>1])->where(["OrganizationOfficers.organization_id"=>$organization_id]);
                         }
                      )->where(["OrganizationOfficersPositions.active"=>1]);
        $this->set('organization_officers_positions', $organization_officers_positions);

        if ($organization_officers_positions->count() == 0) {
            $organization_officers_positions_count = 0;
        }
        else {
            $this->set('organization_officers_positions', $organization_officers_positions);
        }

        $this->loadModel('Organizations');
        $organizations =  $this->Organizations->find('all')->where(['Organizations.organization_id' => $organization_id]);
        $this->set('organizations', $organizations->first());
        $this->title('Edit Officer | ' . $organizations->first()->organization_name);

        $organization_officer =  $this->OrganizationOfficers->find('all', 
                   array('conditions'=>array('OrganizationOfficers.organization_officer_id'=>$organization_officer_id)))->contain(['OrganizationOfficersPositions','Users']);
        $organization_officer = $organization_officer->first();
        $this->set('organization_officer', $organization_officer);
        $this->log($organization_officer,'debug');

        if ($organization_officer->user_id != null) {
             $currentUserFullName = $organization_officer->user->user_lastname . ', ' . $organization_officer->user->user_firstname . ' ' . $organization_officer->user->user_middlename;
            $this->set('currentUserFullName', $currentUserFullName);
        }
       
        $this->loadModel('Users');
        $this->loadModel("User_Types");
        $users = $this->Users->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row['user_lastname'] . ', ' . $row['user_firstname'] . ' ' . $row['user_middlename'];
            }
        ])->notMatching("OrganizationOfficers", 
                         function($q) use($organization_id) {
                            return $q->where(["OrganizationOfficers.active"=>1])->where(["OrganizationOfficers.organization_id"=>$organization_id]);
                         })
        ->where(['Users.active' => 1,'Users.user_lastname IS NOT' => null])->order([
        'Users.user_lastname' => 'ASC'
        ]);
        $this->log($users->count(),'debug');

        $users_count = 1;
        if ($users->count() == 0) {
            $users_count = 0;
        }
        else {
            $this->set('assignUsers', $users);
        }
        $this->set('users_count', $users_count);

        if ($this->request->is(['post', 'put'])) {
            if (!empty($this->request->data)) {
                if (!empty($this->request->data['officer_photo']['name'])) {
                    $file = $this->request->data['officer_photo']; //put the data into a var for easy use

                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                    $arr_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions
                    $setNewFileName = time() . "_" . rand(000000, 999999);

                    //only process if the extension is valid
                    if (in_array($ext, $arr_ext)) {
                        //do the actual uploading of the file. First arg is the tmp name, second arg is 
                        //where we are putting it
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/upload/' . $setNewFileName . '.' . $ext);

                        //prepare the filename for database entry 
                        $imageFileName = $setNewFileName . '.' . $ext;
                        }
                    }
                    else {
                        $imageFileName = $organization_officer->officer_photo;
                    }


            $officersTable = TableRegistry::get('OrganizationOfficers');

            $officersTable = TableRegistry::getTableLocator()->get('OrganizationOfficers');
            $officers = $officersTable->get($organization_officer_id);

            $officers->officers_position_id = $this->request->data['officers_position_id'];
            $officers->officer_lastname = $this->request->data['officer_lastname'];
            $officers->officer_firstname = $this->request->data['officer_firstname'];
            $officers->officer_middlename = $this->request->data['officer_middlename'];
            $officers->officer_photo = $imageFileName;
            $officers->user_id = $this->request->data['user_id'];

            if (!empty($this->request->data['organization_officer_photo']['name'])) {
                    $officers->employee_photo = $imageFileName;
                }

            }

            if ($officersTable->save($officers)) {
                $this->Flash->success('Officer Updated!', [
                    'params' => [
                        'saves' => 'Officer Updated!'
                        ]
                    ]);
                return $this->redirect(['action' => 'officers', $organization_id]);
            }
            else {
                debug($officers->errors());
            $this->Flash->error(__('Unable to add your article.'));
            }
            
        }

        // checks if there are available positions
        $this->set('organization_officers_positions_count', $organization_officers_positions_count);
    }

    public function removeOfficer()
    {   
        $this->layout = false;
        $this->autoRender = false;

        $this->loadModel('OrganizationOfficers');

        if ($this->request->is(['post', 'put'])) {

            $organization_officer_id = $this->request->getData('organization_officer_id');

            $officersTable = TableRegistry::get('OrganizationOfficers');

            $officersTable = TableRegistry::getTableLocator()->get('OrganizationOfficers');
            $officer = $officersTable->get($organization_officer_id);

            $officer->active = 0;

            if ($this->OrganizationOfficers->save($officer)) {
                $this->Flash->success('Organization Removed!', [
                    'params' => [
                        'saves' => 'Organization Removed!'
                        ]
                    ]);
            }
            else {
                debug($officer->errors());
            }
            
            $this->Flash->error(__('Unable to add your article.'));
        }
    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        // The add and tags actions are always allowed to logged in users.
        if (in_array($action, ['add', 'edit','index','delete','officers','removeOfficer','addOfficer','editOfficer'])) {
            return true;
        }
    }
}