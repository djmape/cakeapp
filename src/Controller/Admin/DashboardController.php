<?php
// src/Controller/AdminController.php

namespace App\Controller\Admin;

use App\Controller\AppController;

class DashboardController extends AppController
{
    
    public function initialize()
    {   
        parent::initialize();
        $this->adminHeaderSidebar('dashboard');
        $this->adminSideBarHasSub('');
        $this->header();
    }

    public function index()
    {   
        $this->title('PUPQC | Admin Panel');
    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        // The add and tags actions are always allowed to logged in users.
        if (in_array($action, ['index'])) {
            return true;
        }

    }

}