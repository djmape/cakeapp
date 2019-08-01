<?php
// src/Controller/AdminController.php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;

class ContactNumbersController extends AppController
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
         $this->loadComponent('RequestHandler');
        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
        $this->sideBar();
        $this->Flash->success('The user has been saved', [
                    'params' => [
                    'saves' => 'About has been updated successfully!'
                    ] 
        ]);
    }

    public function index()
    {
        $numbers = $this->ContactNumbers->find('all');
        $numbers = $this->Paginator->paginate($numbers);
        $this->set(compact('numbers'));

        $this->set('query', 'queryyyyy');
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
        $this->layout = false;
        $this->autoRender = false;
        $gets = $this->request->getData('contact_number_id');

        $number = $this->ContactNumbers->newEntity();

        if ($this->request->is('POST')) {

            $number->contact_number = $this->request->getData('contact_number_id');

            if ($saved = $this->ContactNumbers->save($number)) {
                $this->Flash->success(__('Your article has been saved.'));
            }
            else {
                debug($number->errors());
            }
            
            $this->Flash->error(__('Unable to add your article.'));
        }

        $query = $this->request->getMethod();
        $this->set('number', $number);
        $this->set('query', $query);
        $this->set('_serialize', ['query']);
        $this->response->body($query);
        return $this->response;

    }
    
    public function edit($contact_number_id)
    {
        $layout = 'ajax'; // you need to have a no html page, only the data.
        $this->autoRender = false;

        $numbers = $this->ContactNumbers->find('all', 
                   array('conditions'=>array('ContactNumbers.contact_number_id'=>$contact_number_id)));

        $numbers = $numbers->first();

        $this->set('numbers', $numbers);

        if ($this->request->is(['post', 'put'])) {

            $numbersTable = TableRegistry::get('ContactNumbers');

            $numbersTable = TableRegistry::getTableLocator()->get('ContactNumbers');
            $number = $numbersTable->get($contact_number_id);

            $number->contact_number = $this->request->data['contact_number'];

            if ($numbersTable->save($number)) {
                $this->Flash->success(__('Your article has been saved.'));
                return $this->redirect(['action' => 'edit', $contact_number_id]);
            }
            else {
                debug($number->errors());
            }
            
            $this->Flash->error(__('Unable to add your article.'));
        }
        // Get a list of tags.

    }

    public function deletes()
    {   
        $gets = $this->request->getData('contact_number_id');

        $number = $this->ContactNumbers->newEntity();

        if ($this->request->is('POST')) {

            $number->contact_number = $this->request->getData('contact_number_id');

            if ($saved = $this->ContactNumbers->save($number)) {
                $this->Flash->success(__('Your article has been saved.'));
            }
            else {
                debug($number->errors());
            }
            
            $this->Flash->error(__('Unable to add your article.'));
        }

        $query = $this->request->getMethod();
        $this->set('number', $number);
        $this->set('query', $query);
        $this->set('_serialize', ['query']);
        $this->response->body($query);
        return $this->response;
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