<?php
// src/Controller/AdminController.php

namespace App\Controller\Admin;

use App\Controller\AppController;

class OrganizationsController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
        $this->Auth->allow(['tags']);
    }

    public function index()
    {
        $this->loadComponent('Paginator');
        $this->loadModel('Articles');
        $articles = $this->Paginator->paginate($this->Articles->find('all',array('order'=>array('Articles.created DESC')))->where(['Articles.status' => 1]));
        $this->set(compact('articles'));
    }

    public function view($slug = null)
	{
        $this->loadComponent('Paginator');
        $this->loadModel('Articles');
        $articles = $this->Paginator->paginate($this->Articles->find('all',array('order'=>array('Articles.created DESC')))->where(['Articles.status' => 1]));
        $this->set(compact('articles'));
	}

    public function add()
    {
        $organization = $this->Organizations->newEntity();

        if ($this->request->is('post')) {

            $organization->organization_type = $this->request->data['organization_type'];
            $organization->organization_name = $this->request->data['organization_name'];
            $organization->organization_acronym = $this->request->data['organization_acronym'];
            $organization->organization_mission = $this->request->data['organization_mission'];
            $organization->organization_vision = $this->request->data['organization_vision'];
            $organization->organization_goals = $this->request->data['organization_goals'];
            $organization->organization_objective = $this->request->data['organization_objective'];
            $organization->organization_status = 1;
            $organization->organization_photo = '_default.jpg';

            if ($this->Organizations->save($organization)) {
                $this->Flash->success(__('Your article has been saved.'));
            }
            else {
                debug($organization->errors("?"));
            }
            
            $this->Flash->error(__('Unable to add your article.'));  
        }
        $this->log($this->request);
        $this->set('organization', $organization);
    }
    
    public function edit()
    {
        $this->set('title', 'View Active Users');
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
        if (in_array($action, ['add', 'edit'])) {
            return true;
        }

        // All other actions require a slug.
        $slug = $this->request->getParam('pass.0');
        if (!$slug) {
            return false;
        }

        // Check that the article belongs to the current user.
        $article = $this->Articles->findBySlug($slug)->first();

        return $article->user_id === $user['id'];
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