<?php
// src/Controller/AdminController.php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

class OfficesController extends AppController
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
        $offices = $this->Paginator->paginate($this->Offices->find('all'));
        $this->set(compact('offices'));
    }

    public function view($slug = null)
	{
        $this->loadComponent('Paginator');
        $organizations = $this->Paginator->paginate($this->Organizations->find('all')->where(['Organizations.organization_status' => 1]));
        $this->set(compact('organizations'));
	}

    public function add()
    {
        $offices = $this->Offices->newEntity();
        if ($this->request->is('post')) {
            $offices = $this->Offices->patchEntity($offices, $this->request->getData());


            if ($this->Offices->save($offices)) {
                $this->Flash->success(__('Your article has been saved.'));
                #return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your article.'));
        }
        $this->set('offices', $offices);
    }
    
    public function edit($office_id)
    {
        $offices = $this->Offices->find('all', 
                   array('conditions'=>array('EmployeePositions.office_id'=>$office_id)));
        $row = $offices->first();

        if ($this->request->is(['post', 'put'])) {

            $officesTable = TableRegistry::get('Offices');

            $officesTable = TableRegistry::getTableLocator()->get('Offices');
            $offices = $officesTable->get($office_id);

            $this->EmployeePositions->patchEntity($offices, $this->request->getData());
            
            if ($officesTable->save($offices)) {
                $this->Flash->success(__('Your article has been updated.'));
                return $this->redirect(['action' => 'edit',$office_id]);
            }
            $this->Flash->error(__('Unable to update your article.'));
        }

        $this->set('offices', $offices);
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