<?php
// src/Controller/AdminController.php

namespace App\Controller\Front;

use App\Controller\AppController;

class EmployeesController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
        $this->Auth->allow(['index']);
        $this->navBar();
        $this->adminSideBar('employees');
    }

    public function index()
    {
        $employees = $this->Employees->find('all')->contain(['EmployeePositions' => ['sort' => ['EmployeePositions.employee_position_priority' => 'DESC']]])->innerJoinWith('EmployeePositions')->order([
        'EmployeePositions.employee_position_priority' => 'ASC'
        ])->where(['Employees.active' => 1]);
        $employees = $this->paginate($employees);
        $this->set(compact('employees'));

    }


    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        // The add and tags actions are always allowed to logged in users.
        if (in_array($action, ['add', 'tags','index'])) {
            return true;
        }

    }

}