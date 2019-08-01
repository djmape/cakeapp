<?php
// src/Controller/AdminController.php

namespace App\Controller\Admin;

use App\Controller\AppController;

class OrganizationOfficersPositionsController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
        $this->Auth->allow(['index']);
    }

    public function index()
    {   
        $organization_officers_positions = $this->Paginator->paginate($this->OrganizationOfficersPositions->find('all'));
        $this->set(compact('organization_officers_positions'));
    }

    public function view($slug = null)
	{
        $this->loadModel('Articles');
        $article = $this->Articles->findBySlug($slug)->contain(['Tags'])->firstOrFail();
    	$this->set(compact('article'));
	}

    public function add()
    {

        $organization_officers_positions = $this->OrganizationOfficersPositions->newEntity();
        if ($this->request->is('post')) {
            $organization_officers_positions = $this->OrganizationOfficersPositions->patchEntity($organization_officers_positions, $this->request->getData());


            if ($this->OrganizationOfficersPositions->save($organization_officers_positions)) {
                $this->Flash->success(__('Your article has been saved.'));
                #return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your article.'));
        }
        $this->set('organization_officers_positions', $organization_officers_positions);
    }


    public function edit($officers_position_id)
    {
        $organization_officers_positions = $this->OrganizationOfficersPositions->find('all', 
                   array('conditions'=>array('OrganizationOfficersPositions.officers_position_id'=>$officers_position_id)));
        $row = $organization_officers_positions->first();

        if ($this->request->is(['post', 'put'])) {
            $this->OrganizationOfficersPositions->patchEntity($organization_officers_positions, $this->request->getData());
            if ($this->OrganizationOfficersPositions->save($organization_officers_positions)) {
                $this->Flash->success(__('Your article has been updated.'));
                return $this->redirect(['action' => 'edit',$officers_position_id]);
            }
            $this->Flash->error(__('Unable to update your article.'));
        }

        $this->set('organization_officers_positions', $organization_officers_positions);
        $this->set('row', $row);
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
        if (in_array($action, ['add', 'tags','index'])) {
            return true;
        }

    }

}