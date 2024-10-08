<?php
// src/Controller/AdminController.php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class EmployeesController extends AppController
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
        $this->adminSideBarHasSub('employees');
        $this->adminHeaderSideBar('employees');
    }

    public function index()
    {
        $this->title('Admin | Employees');
        $employees = $this->Employees->find('all')->contain(['EmployeePositionNames' => ['sort' => ['EmployeePositionNames.employee_position_priority' => 'DESC']]])->innerJoinWith('EmployeePositionNames')->order([
        'EmployeePositionNames.employee_position_priority' => 'ASC'
        ])->where(['Employees.active' => 1]);
        $employees = $this->paginate($employees);
        $this->set(compact('employees'));
    }

    public function add()
    {
        $this->title('Admin | Add Employees');

        $this->loadModel('EmployeePositionNames');
        $employee_positions =  $this->EmployeePositionNames->find('list', ['keyField' => 'employee_position_id', 'valueField' => 'employee_position_name'])->where(['EmployeePositionNames.active' => 1])->order([
        'EmployeePositionNames.employee_position_priority' => 'ASC'
        ]);
        $this->set('employee_positions', $employee_positions);

        $employee = $this->Employees->newEntity();

        $this->loadModel('Users');
        $this->loadModel("User_Types");
        $users = $this->Users->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row['user_lastname'] . ', ' . $row['user_firstname'] . ' ' . $row['user_middlename'];
            }
        ])->notMatching("Employees", 
                         function($q) {
                            return $q->where(["Employees.active"=>1]);
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
                if (!empty($this->request->data['employee_photo']['name'])) {
                    $this->log('Got here', 'debug');
                    $file = $this->request->data['employee_photo']; //put the data into a var for easy use

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

                $employee->employee_type = $this->request->data['employee_type'];
                $employee->employee_lastname = $this->request->data['employee_lastname'];
                $employee->employee_firstname = $this->request->data['employee_firstname'];
                $employee->employee_middlename = $this->request->data['employee_middlename'];
                $employee->employee_email = $this->request->data['employee_email'];
                $employee->employee_position_id = $this->request->data['employee_position_id'];
                $employee->employee_photo = $imageFileName;
                $employee->active = 1;
                $employee->user_id = $this->request->data['user_id'];

                    if (!empty($this->request->data['employee_photo']['name'])) {
                        $employee->employee_photo = $imageFileName;
                    }

            }

            if ($saved = $this->Employees->save($employee)) {
                $this->Flash->success('Employee Added!', [
                    'params' => [
                        'saves' => 'Employee Added!'
                        ]
                    ]);
                return $this->redirect(['action' => 'index']);
            }
            else {
                debug($employee->errors());
            }
            
            $this->Flash->error(__('Unable to add your article.'));
        }

        $this->set('employees', $employee);
    }
    
    public function edit($employee_id)
    {
        $this->title('Admin | Edit Employee');

        $this->loadModel('EmployeePositionNames');
        $employee = $this->Employees->find('all', 
                   array('conditions'=>array('Employees.employee_id'=>$employee_id)));
        $employee_positions =  $this->EmployeePositionNames->find('list', ['keyField' => 'employee_position_id', 'valueField' => 'employee_position_name'])->where(['EmployeePositionNames.active' => 1])->order([
        'EmployeePositionNames.employee_position_priority' => 'ASC'
        ]);
        $employee_name = $this->Employees->find('all')->where(['Employees.employee_id'=>$employee_id])->contain(['EmployeePositionNames','Users']);

        $row = $employee->first();
        $employee_name = $employee_name->first();

        if ($employee_name->user_id != null) {
             $currentUserFullName = $employee_name->user->user_lastname . ', ' . $employee_name->user->user_firstname . ' ' . $employee_name->user->user_middlename;
            $this->set('currentUserFullName', $currentUserFullName);
        }

        $this->set('employee_name', $employee_name);
        $this->set('employee_positions', $employee_positions);
        $this->set('employee', $employee);
        $this->set('row', $row);

        $this->loadModel('Users');
        $this->loadModel("User_Types");
        $users = $this->Users->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row['user_lastname'] . ', ' . $row['user_firstname'] . ' ' . $row['user_middlename'];
            }
        ])->notMatching("Employees", 
                         function($q) {
                            return $q->where(["Employees.active"=>1]);
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
                if (!empty($this->request->data['employee_photo']['name'])) {
                    $file = $this->request->data['employee_photo']; //put the data into a var for easy use

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
                        $imageFileName = $row->employee_photo;
                    }


            $employeesTable = TableRegistry::get('Employees');

            $employeesTable = TableRegistry::getTableLocator()->get('Employees');
            $employees = $employeesTable->get($employee_id);

            $employees->employee_type = $this->request->data['employee_type'];
            $employees->employee_lastname = $this->request->data['employee_lastname'];
            $employees->employee_firstname = $this->request->data['employee_firstname'];
            $employees->employee_middlename = $this->request->data['employee_middlename'];
            $employees->employee_email = $this->request->data['employee_email'];
            $employees->employee_position_id = $this->request->data['employee_position_id'];
            $employees->employee_photo = $imageFileName;

                    if (!empty($this->request->data['employee_photo']['name'])) {
                        $employees->employee_photo = $imageFileName;
                    }

            }

            if ($employeesTable->save($employees)) {
                $this->Flash->success('Employee Updated!', [
                    'params' => [
                        'saves' => 'Employee Updated!'
                        ]
                    ]);
                return $this->redirect(['action' => 'index']);
            }
            else {
                debug($employee->errors());
                $this->Flash->error(__('Unable to add employee.'));
            }
            
        }
        // Get a list of tags.

    }

    public function delete()
    {   
        $this->layout = false;
        $this->autoRender = false;

        if ($this->request->is(['post', 'put'])) {

            $employee_id = $this->request->getData('employee_id');

            $employeesTable = TableRegistry::get('Employees');

            $employeesTable = TableRegistry::getTableLocator()->get('Employees');
            $employee = $employeesTable->get($employee_id);

            $employee->active = 0;

            if ($this->Employees->save($employee)) {
                $this->Flash->success('Employee Removed!', [
                    'params' => [
                        'saves' => 'Employee Removed!!'
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

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        // The add and tags actions are always allowed to logged in users.
        if (in_array($action, ['add', 'edit','index','delete'])) {
            return true;
        }
    }
}