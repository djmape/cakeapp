<?php
// src/Controller/AdminController.php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class OfficeEmployeesController extends AppController
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
    }

    public function index()
    {
        $this->loadModel('Offices');
        $offices = $this->Paginator->paginate($this->Offices->find('all'));
        $this->set(compact('offices'));
    }


    public function view($slug = null)
    {
        $this->loadComponent('Paginator');
        $this->loadModel('Articles');
        $articles = $this->Paginator->paginate($this->Articles->find('all',array('order'=>array('Articles.created DESC')))->where(['Articles.status' => 1]));
        $this->set(compact('articles'));
    }

    public function add($office_id)
    {
        $this->loadModel('Offices');
        $offices = $this->Offices->find('all', 
                   array('conditions'=>array('Offices.office_id'=>$office_id)));
        $offices = $offices->first();
        $this->set('offices', $offices);

        $this->loadModel('Employees');
        $employees =  $this->Employees->find('list', ['keyField' => 'employee_id', 'valueField' => 'employee_name']);
        $this->set('employees', $employees);

        $office_employees = $this->OfficeEmployees->newEntity();

        if ($this->request->is('post')) { 

            $office_employees->office_id = $office_id;
            $office_employees->employee_id =  $this->request->data['employee_id'];

            if ($saved = $this->OfficeEmployees->save($office_employees)) {
                $this->Flash->success(__('Your article has been saved.'));
                return $this->redirect(['action' => 'view', $office_id]);
            }
            $this->Flash->error(__('Unable to add your article.'));
        }

        $this->set('office_employees', $office_employees);
    }
    
    public function edit($office_id)
    {
        $this->loadModel('OfficeEmployees');

        $office_employees = $this->OfficeEmployees->find('all')->contain(['Employees','Offices'])->where(['Offices.office_id' => $office_id]);
        $office_employees = $this->Paginator->paginate($office_employees);
        $this->set(compact('office_employees'));

        $this->loadModel('Employees');
        $employees =  $this->Employees->find('list', ['keyField' => 'employee_id', 'valueField' => 'employee_name']);
        $this->set('employees', $employees);

        $this->loadModel('Offices');
        $offices = $this->Offices->find('all', 
                   array('conditions'=>array('Offices.office_id'=>$office_id)));
        $row = $offices->first();

        $this->set('row', $row);
        $this->set('office_employees', $office_employees);
    }

    public function delete($slug)
    {
        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        if ($this->request->is(['post', 'put'])) {
            $article->status = 0;
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The {0} article has been deleted.', $article->title));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to delete your article.'));
        }
        $this->set('article', $article);
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
        if (in_array($action, ['add', 'edit','index'])) {
            return true;
        }

    }

    public function announcement()
    {
        $this->loadComponent('Paginator');
        $articles = $this->Paginator->paginate($this->Articles->find()->where(['Articles.status' => 1]));
        $this->set(compact('articles'));
    }

    public function sub()
    {

    }
}