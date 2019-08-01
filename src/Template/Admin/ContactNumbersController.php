<?php
// src/Controller/AdminController.php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class ContactNumbersController extends AppController
{
	public function initialize()
    {   
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash');
        $this->sideBar();
    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        // The add and tags actions are always allowed to logged in users.
        if (in_array($action, ['index','add','edit'])) {
            return true;
        }

    }
}

?>