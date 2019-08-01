<?php
// src/Controller/AdminController.php

namespace App\Controller\Front;

use App\Controller\AppController;

class OfficesController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
        $this->Auth->allow(['index']);
        $this->navBar();
        $this->adminSideBar('offices');
    }

    public function index()
    {
        $this->loadModel('Offices');

        $offices = $this->Offices->find('all')->where(['Offices.active' => 1]);
        $offices = $this->paginate($offices);
        $this->set('offices', $offices);

        $this->loadModel('OfficeEmployees');
        $office_employees = $this->OfficeEmployees->find('all')->contain(['Offices','Employees'])->innerJoinWith('Offices')->where(['OfficeEmployees.active' => 1]);
        $office_employees = $this->Paginator->paginate($office_employees);
        $this->set('office_employees', $office_employees);

    }

    public function view($office_id)
	{
        $this->loadModel('Offices');

        $office = $this->Offices->find('all', 
                   array('conditions'=>array('Offices.office_id'=>$office_id)));
        $office = $office->first();

        $this->set('office', $office);

        $this->loadModel('OfficeEmployees');
        $office_employees = $this->OfficeEmployees->find('all')->contain(['Employees','Offices','OfficePositions'])->where(['Offices.office_id' => $office_id])->where(['Employees.active' => 1])->where(['OfficeEmployees.active' => 1]);
        $office_employees = $this->Paginator->paginate($office_employees);
        $this->set(compact('office_employees'));
	}

    public function add()
    {
        $query = $this->Abouts->find('all', [
            'order' => ['Abouts.about_modified' => 'DESC']
        ]);
        $row = $query->first();

        $about = $this->Abouts->newEntity();
        if ($this->request->is('post')) {
            $about = $this->Abouts->patchEntity($about, $this->request->getData());

            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.

            if ($this->Abouts->save($about)) {
                $this->Flash->success(__('Your article has been saved.'));
            }
            else {
                debug($about->errors("?"));
            }
                $this->log('Got here', 'debug');
            
            $this->Flash->error(__('Unable to add your article.'));  
        }
        // Get a list of tags.

        $this->set('about', $about);
        $this->set('row', $row);
    }

    public function edit($slug)
    {
        $article = $this->Articles->findBySlug($slug)->contain('Tags')->firstOrFail();
        if ($this->request->is(['post', 'put'])) {
            $this->Articles->patchEntity($article, $this->request->getData(), [
            'accessibleFields' => ['user_id' => false]
        ]);
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your article.'));
        }
        // Get a list of tags.
        $tags = $this->Articles->Tags->find('list');

        // Set tags to the view context
        $this->set('tags', $tags);

        $this->set('article', $article);
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
        if (in_array($action, ['view','positions'])) {
            return true;
        }

    }


}