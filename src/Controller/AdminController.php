<?php
// src/Controller/AdminController.php

namespace App\Controller;

class AdminController extends AppController
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
        $this->Auth->allow(['tags']);
        $this->sideBar();
        $this->adminSideBarHasSub('admin');
        $this->adminSideBar('');
    }

    public function index()
    {
        $this->loadComponent('Paginator');
        $this->loadModel('Events');

        $current = date("Y-m-d");
        $this->log($current,'debug');
        $events = $this->paginate($this->Events->find('all')->where(['Events.event_status' => 'Ongoing']));
        $this->set(compact('events'));
        $upcomingEvents = $this->paginate($this->Events->find('all')->where(['Events.event_status' => 'Upcoming']));
        $this->set(compact('upcomingEvents'));
    }

    public function view($slug = null)
	{
        $this->loadModel('Articles');
        $article = $this->Articles->findBySlug($slug)->contain(['Tags'])->firstOrFail();
    	$this->set(compact('article'));
	}

    public function add()
    {
        $article = $this->Articles->newEntity();
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());

            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            $article->user_id = $this->Auth->user('id');
            $article->status = 1;

            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your article.'));
        }
        // Get a list of tags.
        $tags = $this->Articles->Tags->find('list');

        // Set tags to the view context
        $this->set('tags', $tags);
        $this->set('article', $article);
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
        if (in_array($action, ['add', 'tags'])) {
            return true;
        }
        if ($this->request->getParam('action') === 'index') {
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
        $this->Auth->allow(['display', 'view', 'index']);
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