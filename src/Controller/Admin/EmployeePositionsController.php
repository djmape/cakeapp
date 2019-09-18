<?php
// src/Controller/AdminController.php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class EmployeePositionsController extends AppController
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
        $this->adminSideBar('employees');
    }

    public function index()
    {   
        $employee_positions = $this->Paginator->paginate($this->EmployeePositions->find('all')->order(['EmployeePositions.employee_position_priority' => 'ASC'
        ])->where(['EmployeePositions.active' => 1]));
        $this->set(compact('employee_positions'));
    }

    public function add()
    {

        $employee_positions = $this->EmployeePositions->newEntity();
        if ($this->request->is('post')) {

            $employee_positions->employee_position_name = $this->request->getData('employee_position_name');
            $employee_positions->employee_position_priority = $this->request->getData('employee_position_priority');
            $employee_positions->active = 1;

            if ($saved = $this->EmployeePositions->save($employee_positions)) {
                $this->Flash->success('Employee Position Added!', [
                    'params' => [
                        'saves' => 'Employee Position Added!!'
                        ]
                    ]);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your article.'));
        }
        $this->set('employee_positions', $employee_positions);
    }
    
    public function edit($employee_position_id)
    {
        $employee_positions = $this->EmployeePositions->find('all', 
                   array('conditions'=>array('EmployeePositions.employee_position_id'=>$employee_position_id)));
        $row = $employee_positions->first();

        if ($this->request->is(['post', 'put'])) {

            $employeePositionsTable = TableRegistry::get('EmployeePositions');

            $employeePositionsTable = TableRegistry::getTableLocator()->get('EmployeePositions');
            $employee_positions = $employeePositionsTable->get($employee_position_id);

            $this->EmployeePositions->patchEntity($employee_positions, $this->request->getData());
            
            if ($employeePositionsTable->save($employee_positions)) {
                $this->Flash->success('Employee Position Updated!', [
                    'params' => [
                        'saves' => 'Employee Position Updated!!'
                        ]
                    ]);
                return $this->redirect(['action' => 'index']);
            }
            else {
                $this->Flash->error(__('Unable to update your article.'));
            }
        }

        $this->set('employee_positions', $employee_positions);
        $this->set('row', $row);
    }

    public function delete()
    {   
        $this->log('Passed','debug');
        $this->layout = false;
        $this->autoRender = false;

        if ($this->request->is(['post', 'put'])) {

            $this->log('Passed','debug');
            $employee_position_id = $this->request->getData('employee_position_id');

            $employeePositionsTable = TableRegistry::get('EmployeePositions');

            $employeePositionsTable = TableRegistry::getTableLocator()->get('EmployeePositions');
            $employeePosition = $employeePositionsTable->get($employee_position_id);

            $employeePosition->active = 0;

            if ($saved = $this->EmployeePositions->save($employeePosition)) {
                $this->Flash->success('Employee Position Deleted!', [
                    'params' => [
                        'saves' => 'Employee Position Deleted!!'
                        ]
                    ]);
            }
            else {
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