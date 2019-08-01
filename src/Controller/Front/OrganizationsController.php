<?php
// src/Controller/AdminController.php

namespace App\Controller\Front;

use App\Controller\AppController;

class OrganizationsController extends AppController
{
    public function navBar() {
        $this->loadModel('Courses');
        $courses =  $this->Courses->find('all');
        $this->set(compact('courses', $courses));
        $this->loadModel('Organizations');
        $organizations =  $this->Organizations->find('all');
        $this->set(compact('organizations', $organizations));
        $this->loadModel('Offices');
        $offices =  $this->Offices->find('all');
        $this->set(compact('offices', $offices));
    }

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
        $this->Auth->allow(['index']);
        $this->navBar();
        $this->adminSideBar('organizations');
    }

    public function index()
    {
        $this->loadModel('Announcements');
        $announcements = $this->Paginator->paginate($this->Announcements->find('all'));
        $this->set(compact('announcements'));

    }

    public function view($organization_id)
	{
        $this->loadModel('Organizations');

        $organization = $this->Organizations->find('all', 
                   array('conditions'=>array('Organizations.organization_id'=>$organization_id)));
        $organization = $organization->first();

        $this->set('organization', $organization);

        $this->loadModel('OrganizationOfficers');
        $organization_officers = $this->OrganizationOfficers->find('all')->contain(['OrganizationOfficersPositions' => ['sort' => ['OrganizationOfficersPositions.officers_position_priority' => 'DESC']],'Organizations'])->innerJoinWith('OrganizationOfficersPositions')->order(['OrganizationOfficersPositions.officers_position_priority' => 'ASC'])->where(['Organizations.organization_id' => $organization_id])->where(['OrganizationOfficers.active' => 1]);
        $organization_officers = $this->Paginator->paginate($organization_officers);
        $this->set('organization_officers', $organization_officers);
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
        if (in_array($action, ['add', 'tags','index','view'])) {
            return true;
        }

    }

}