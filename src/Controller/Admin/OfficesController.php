<?php
// src/Controller/AdminController.php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

class OfficesController extends AppController
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
        $this->adminSideBarHasSub('offices');
        $this->adminSideBar('');
    }

    public function index()
    {
        $this->adminSideBar('all');
        $offices = $this->Paginator->paginate($this->Offices->find('all')->where(['Offices.active' => 1])->order([
        'Offices.priority' => 'ASC'
        ]));
        $this->set(compact('offices'));
    }

    public function view($office_id)
    {
        $this->loadModel('OfficeEmployees');

        $office_employees = $this->OfficeEmployees->find('all')->contain(['Employees','Offices'])->where(['Offices.office_id' => $office_id]);
        $office_employees = $this->Paginator->paginate($office_employees);
        $this->set(compact('office_employees'));

        $this->loadModel('Employees');
        $employees =  $this->Employees->find('list', ['keyField' => 'employee_id', 'valueField' => 'employee_name']);
        $this->set('employees', $employees);

        $offices = $this->Offices->find('all', 
                   array('conditions'=>array('Offices.office_id'=>$office_id)));
        $row = $offices->first();


        $this->set('row', $row);
        $this->set('office_employees', $office_employees);
    }

    public function add()
    {
        $this->adminSideBar('add');
        $offices = $this->Offices->newEntity();
        if ($this->request->is('post')) {

            if (!empty($this->request->data)) {
                if (!empty($this->request->data['office_photo']['name'])) {
                    $file = $this->request->data['office_photo']; //put the data into a var for easy use

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
                        $imageFileName = 'default_office_photo.png';
                    }

                $offices->office_name = $this->request->data['office_name'];
                $offices->office_description = $this->request->data['office_description'];
                $offices->office_photo = $imageFileName;
                $offices->priority = $this->request->data['priority'];
                $offices->active = 1;

            }

            if ($saved = $this->Offices->save($offices)) {
                $this->Flash->success('Office Added!', [
                    'params' => [
                        'saves' => 'Office Added!'
                        ]
                    ]);
                return $this->redirect(['action' => 'index']);
            }
            else {
                $this->Flash->error(__('Unable to add your article.'));
            }
        }
        $this->set('offices', $offices);
    }
    
    
    public function edit($office_id)
    {
        $this->adminSideBar('New Office');
        $office = $this->Offices->find('all')->where(['Offices.office_id'=>$office_id]);

        $row = $office->first();

        $this->set('office', $office);
        $this->set('row', $row);

        if ($this->request->is(['post', 'put'])) {

            if (!empty($this->request->data)) {
                if (!empty($this->request->data['office_photo']['name'])) {
                    $file = $this->request->data['office_photo']; //put the data into a var for easy use

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
                        $imageFileName = 'default_office_photo.png';
                    }

            }
           

            $officesTable = TableRegistry::get('Offices');

            $officesTable = TableRegistry::getTableLocator()->get('Offices');
            $offices = $officesTable->get($office_id);

            $offices->office_name = $this->request->data['office_name'];
            $offices->office_description = $this->request->data['office_description'];
            $offices->office_photo = $imageFileName;
            $offices->priority = $this->request->data['priority'];


            if ($officesTable->save($offices)) {
                $this->Flash->success('Office Updated!', [
                    'params' => [
                        'saves' => 'Office Updated!'
                        ]
                    ]);
                return $this->redirect(['action' => 'index']);
            }
            else {
                debug($offices->errors());
                $this->Flash->error(__('Unable to add your article.'));
            }
            
        }
    }

    public function delete()
    {   
        $this->layout = false;
        $this->autoRender = false;

        if ($this->request->is(['post', 'put'])) {

            $office_id = $this->request->getData('office_id');

            $officesTable = TableRegistry::get('Offices');

            $officesTable = TableRegistry::getTableLocator()->get('Offices');
            $office = $officesTable->get($office_id);

            $office->active = 0;

            if ($this->Offices->save($office)) {
                $this->Flash->success('Office Deleted!', [
                    'params' => [
                        'saves' => 'Office Deleted!'
                        ]
                    ]);
            }
            else {
                debug($number->errors());
                $this->Flash->error(__('Unable to add your article.'));
            }
        }
    }

    public function tags()
    {
        // The 'pass' key is provided by CakePHP and contains all
        // the passed URL path segments in the request.
        $tags = $this->request->getParam('pass');

        // Use the ArticlesTable to find tagged articles.
        $articles = $this->Articles->find('tagged', [
            'tags' => $tags
        ]);

        // Pass variables into the view template context.
        $this->set([
            'articles' => $articles,
            'tags' => $tags
        ]);
    }


    public function positions($office_id)
    {
        $this->adminSideBar('New Office');
        $offices = $this->Offices->find('all', 
                   array('conditions'=>array('Offices.office_id'=>$office_id)));
        $offices = $offices->first();
        $this->set('offices', $offices);

        $this->loadModel('OfficeEmployees');
        $office_employees = $this->OfficeEmployees->find('all')->contain(['OfficePositions' => ['sort' => ['OfficePositions.office_position_priority' => 'DESC']],'Employees','Offices'])->innerJoinWith('OfficePositions')->order([
        'OfficePositions.office_position_priority' => 'ASC'
        ])->where(['Offices.office_id' => $office_id])->where(['Employees.active' => 1])->where(['OfficeEmployees.active' => 1])->where(['OfficePositions.active' => 1]);
        $office_employees = $this->paginate($office_employees);
        $this->set(compact('office_employees'));
    }


    public function addPosition($office_id)
    {
        $office_officers_positions_count = 1;
        $employee_count = 1;

        $this->adminSideBar('New Office');
        $this->loadModel('OfficeEmployees');

        $offices = $this->Offices->find('all', 
                   array('conditions'=>array('Offices.office_id'=>$office_id)));
        $offices = $offices->first();
        $this->set('offices', $offices);

        $this->loadModel('Employees'); 
        $employees =  $this->Employees->find('list', ['keyField' => 'employee_id', 'valueField' => function ($row) {
            return $row['employee_lastname'] . ', ' . $row['employee_firstname'] . ' ' . substr($row['employee_middlename'],0,1);}])->notMatching("OfficeEmployees", 
                         function($q) use($office_id) {
                            return $q->where(["OfficeEmployees.active"=>1])->where(["OfficeEmployees.office_id"=>$office_id]);
                         }
                      )->where(["Employees.active"=> 1 ]);

        if ($employees->count() == 0) {
            $this->log($employees->count(). ' zero','debug');
            $employee_count = 0;
        }
        else {
            $this->set('employees', $employees);
        }


        $this->loadModel('OfficePositions');
        // Get unassigned positions only
        $positions =  $this->OfficePositions->find('list', ['keyField' => 'office_position_id', 'valueField' => 'office_position_name' ])->notMatching("OfficeEmployees", 
                         function($q) use ($office_id) {
                            return $q->where(["OfficeEmployees.active"=>1])->where(["OfficeEmployees.office_id"=>$office_id]);
                         }
                      );

        if ($positions->count() == 0) {
            $this->log($positions->count(). ' zero','debug');
            $office_officers_positions_count = 0;
        }
        else {
            $this->set('positions', $positions);
        }
        $this->log($positions->count(),'debug');


        $office_employees = $this->OfficeEmployees->newEntity();

        if ($this->request->is('post')) { 

            $employee_id = $this->request->data['employee_id'];
            $office_position_id = $this->request->data['office_position_id'];

            $fancyTable = TableRegistry::get('OfficeEmployees');
            $exists = $fancyTable->exists(['employee_id' => $employee_id, 'office_position_id' => $office_position_id, 'office_id' => $office_id]);

            $office_employees->office_id = $office_id;
            $office_employees->employee_id =  $employee_id;
            $office_employees->office_position_id = $office_position_id;
            $office_employees->active =  1;

            $this->log($exists,'debug');

                if ($saved = $this->OfficeEmployees->save($office_employees)) {
                    $this->Flash->success('Employee Added!', [
                        'params' => [
                            'saves' => 'Employee Added!'
                            ]
                        ]);
                    $this->log("yay",'debug');
                    return $this->redirect(['action' => 'positions', $office_id]);
                }
                else {
                    $this->Flash->error(__('Unable to add your article.'));
                }
            
        }

        $this->set('office_employees', $office_employees);

        // checks if there are available positions
        $this->set('office_officers_positions_count', $office_officers_positions_count);
        // checks if there are available employees
        $this->set('employee_count', $employee_count);
    }

    public function editOfficePosition($office_employees_id,$office_id,$employee_id)
    {   
        $office_officers_positions_count = 1;

        $this->adminSideBar('New Office');
        $this->loadModel('OfficeEmployees');

        $offices = $this->Offices->find('all', 
                   array('conditions'=>array('Offices.office_id'=>$office_id)));
        $offices = $offices->first();
        $this->set('offices', $offices);

        $this->loadModel('Employees'); 
        $employees =  $this->Employees->find('all', 
                   array('conditions'=>array('Employees.employee_id'=>$employee_id)));
        $this->set('employee', $employees->first());

        $office_employees = $this->OfficeEmployees->find('all', 
                   array('conditions'=>array('OfficeEmployees.office_employees_id'=>$office_employees_id)))->contain(['OfficePositions']);
        $office_employees = $office_employees->first();
        $this->set('office_employees', $office_employees);

        $this->loadModel('OfficePositions'); 
        $positions =  $this->OfficePositions->find('list', ['keyField' => 'office_position_id', 'valueField' => 'office_position_name' ])->notMatching("OfficeEmployees", 
                         function($q) use ($office_id) {
                            return $q->where(["OfficeEmployees.active"=>1])->where(["OfficeEmployees.office_id"=>$office_id]);
                         }
                      );

        if ($positions->count() == 0) {
            $this->log($positions->count(). ' zero','debug');
            $office_officers_positions_count = 0;
        }
        else {
            $this->set('positions', $positions);
        }

        if ($this->request->is(['post', 'put'])) {

            $officeEmployeesTable = TableRegistry::get('OfficeEmployees');

            $office_position_id =  $this->request->data['office_position_id'];

            // check if record already exists
            $exists = $officeEmployeesTable->exists(['employee_id' => $employee_id, 'office_position_id' => $office_position_id, 'office_id' => $office_id]);

            $officeEmployeesTable = TableRegistry::getTableLocator()->get('OfficeEmployees');
            $office_employee = $officeEmployeesTable->get($office_employees_id);

            $office_employee->office_id = $office_id;
            $office_employee->employee_id =  $employee_id;
            $office_employee->office_position_id = $office_position_id;
            $office_employee->active =  1;

            if ($officeEmployeesTable->save($office_employee)) {
                    $this->Flash->success('Office Employee Updated!', [
                        'params' => [
                            'saves' => 'Office Employee Updated!'
                            ]
                        ]);;
                    return $this->redirect(['action' => 'positions', $office_id]);
                }
                else {
                    debug($offices->errors());
                    $this->Flash->error(__('Unable to add your article.'));
                }
        }

        // checks if there are available positions
        $this->set('office_officers_positions_count', $office_officers_positions_count);
    }

    public function removeEmployee()
    {   
        $this->layout = false;
        $this->autoRender = false;

        $this->loadModel('OfficeEmployees');
        
        if ($this->request->is(['post', 'put'])) {

            $office_employees_id = $this->request->getData('office_employees_id');

            $officeEmployeesTable = TableRegistry::get('OfficeEmployees');

            $officeEmployeesTable = TableRegistry::getTableLocator()->get('OfficeEmployees');
            $office_employee = $officeEmployeesTable->get($office_employees_id);

            $office_employee->active = 0;

            if ($this->OfficeEmployees->save($office_employee)) {
                $this->Flash->success('Employee Removed!', [
                    'params' => [
                        'saves' => 'Employee Removed!!'
                        ]
                    ]);
            }
            else {
                debug($office_employee->errors());
                $this->log('$office_employee->errors()','debug');
                $this->Flash->error(__('Unable to add your article.'));
            }
            
        }
    }

    public function officePositions() 
    {
        $this->adminSideBarHasSub('settings');
        $this->adminSideBar('offices');

        $this->loadModel('OfficePositions'); 
        $office_positions = $this->OfficePositions->find('all')->where(['OfficePositions.active' => 1]);
        $office_positions = $this->Paginator->paginate($office_positions);
        $this->set(compact('office_positions'));
    }

    public function addOfficePosition() 
    {
        $this->adminSideBarHasSub('settings');
        $this->adminSideBar('offices');

        $this->loadModel('OfficePositions');

        $office_position = $this->OfficePositions->newEntity();

        if ($this->request->is('post')) {


            $office_position->office_position_name = $this->request->getData('office_position_name');
            $office_position->office_position_priority = $this->request->getData('office_position_priority');
            $office_position->active = 1;

            if ($saved = $this->OfficePositions->save($office_position)) {
                $this->Flash->success('Office Position Added!', [
                    'params' => [
                        'saves' => 'Office Position Added!!'
                        ]
                    ]);
                return $this->redirect(['action' => 'officePositions']);
            }
            else {
                $this->Flash->error(__('Unable to add your article.'));
            }
        }
        $this->set('office_position', $office_position);
    }

    public function editOfficePositions($office_position_id)
    {
        $this->adminSideBarHasSub('settings');
        $this->adminSideBar('offices');

        $this->loadModel('OfficePositions');

        $office_positions = $this->OfficePositions->find('all', 
                   array('conditions'=>array('OfficePositions.office_position_id'=>$office_position_id)));
        $row = $office_positions->first();

        if ($this->request->is(['post', 'put'])) {

            $officePositionsTable = TableRegistry::get('OfficePositions');

            $officePositionsTable = TableRegistry::getTableLocator()->get('OfficePositions');
            $office_position = $officePositionsTable->get($office_position_id);

            $office_position->office_position_name = $this->request->data['office_position_name'];
            $office_position->office_position_priority = $this->request->data['office_position_priority'];

            if ($officePositionsTable->save($office_position)) {
                $this->Flash->success('Office Position Updated!', [
                    'params' => [
                        'saves' => 'Office Position Updated!!'
                        ]
                    ]);
                return $this->redirect(['action' => 'officePositions']);
            }
            else {
                $this->Flash->error(__('Unable to update your article.'));
            }
        }

        $this->set('office_positions', $office_positions);
        $this->set('row', $row);

    }

    public function deleteOfficePosition()
    {   
        $this->layout = false;
        $this->autoRender = false;

        $this->loadModel('OfficePositions');
        
        if ($this->request->is(['post', 'put'])) {

            $office_position_id = $this->request->getData('office_position_id');

            $officePositionsTable = TableRegistry::get('OfficePositions');

            $officeEmployeesTable = TableRegistry::getTableLocator()->get('OfficePositions');
            $office_position = $officePositionsTable->get($office_position_id);

            $office_position->active = 0;

            if ($this->OfficePositions->save($office_position)) {
                $this->Flash->success('Contact Number Removed!', [
                    'params' => [
                        'saves' => 'Contact Number Removed!!'
                        ]
                    ]);
            }
            else {
                debug($office_position->errors());
                $this->log('$office_employee->errors()','debug');
                $this->Flash->error(__('Unable to add your article.'));
            }
            
        }
    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        // The add and tags actions are always allowed to logged in users.
        if (in_array($action, ['add', 'edit','index','delete','positions','addPosition','editOfficePosition','removeEmployee','officePositions','addOfficePosition','editOfficePositions','deleteOfficePosition'])) {
            return true;
        }
    }
}