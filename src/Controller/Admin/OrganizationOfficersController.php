<?php
// src/Controller/AdminController.php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class OrganizationOfficersController extends AppController
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
        $organization_officers = $this->OrganizationOfficers->find('all')->contain(['OrganizationOfficersPositions' => ['sort' => ['OrganizationOfficersPositions.officers_position_priority' => 'DESC']],'Organizations'])->innerJoinWith('Organizations')->innerJoinWith('OrganizationOfficersPositions')->order([
        'OrganizationOfficersPositions.officers_position_priority' => 'ASC'
        ]);
        $organization_officers = $this->Paginator->paginate($organization_officers);
        $this->set(compact('organization_officers'));
        $this->log($organization_officers, 'debug');
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
        $this->loadModel('OrganizationOfficersPositions');
        $organization_officers_positions =  $this->OrganizationOfficersPositions->find('list', ['keyField' => 'officers_position_id', 'valueField' => 'officers_position_name']);
        $this->set('organization_officers_positions', $organization_officers_positions);


        $this->loadModel('Organizations');
        $organization =  $this->Organizations->find('list', ['keyField' => 'organization_id', 'valueField' => 'organization_name']);
        $this->set('organization', $organization);


        $organization_officer = $this->OrganizationOfficers->newEntity();

        $this->set('organization_officer', $organization_officer);

        if ($this->request->is('post')) {
            if (!empty($this->request->data)) {
                $this->log('Got here', 'debug');
                if (!empty($this->request->data['organization_officer_photo']['name'])) {
                    $this->log('Got here', 'debug');
                    $file = $this->request->data['organization_officer_photo']; //put the data into a var for easy use

                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                    $arr_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions
                    $setNewFileName = time() . "_" . rand(000000, 999999);

                    //only process if the extension is valid
                    if (in_array($ext, $arr_ext)) {
                        //do the actual uploading of the file. First arg is the tmp name, second arg is 
                        //where we are putting it
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/upload/' . $setNewFileName . '.' . $ext);

                        //prepare the filename for database entry 
                        $imageFileName = $setNewFileName . '.' . $ext;
                        }
                    }
                    else {
                        $imageFileName = '_default.jpg';
                    }

                $organization_officer->organization_id = $this->request->data['organization_id'];
                $organization_officer->officers_position_id = $this->request->data['officers_position_id'];
                $organization_officer->organization_officer_name = $this->request->data['organization_officer_name'];
                $organization_officer->organization_officer_photo = $imageFileName;

                    if (!empty($this->request->data['employee_photo']['name'])) {
                        $employee->employee_photo = $imageFileName;
                    }

            }

            if ($saved = $this->OrganizationOfficers->save($organization_officer)) {
                $this->Flash->success(__('Your article has been saved.'));
                #return $this->redirect(['action' => 'edit', $saved->organization_officer_id]);
            }
            else {
                debug($employee->errors());
            }
            
            $this->Flash->error(__('Unable to add your article.'));
        }

    }
    
    public function edit($organization_officer_id)
    {
        $this->loadModel('OrganizationOfficersPositions');
        $organization_officers_positions =  $this->OrganizationOfficersPositions->find('list', ['keyField' => 'officers_position_id', 'valueField' => 'officers_position_name']);
        $this->set('organization_officers_positions', $organization_officers_positions);


        $this->loadModel('Organizations');
        $organizations =  $this->Organizations->find('list', ['keyField' => 'organization_id', 'valueField' => 'organization_name']);
        $this->set('organizations', $organizations);

        $organization_officer =  $this->OrganizationOfficers->find('all', 
                   array('conditions'=>array('OrganizationOfficers.organization_officer_id'=>$organization_officer_id)));
        $organization_officer = $organization_officer->first();
        $this->set('organization_officer', $organization_officer);

       

        if ($this->request->is(['post', 'put'])) {
            if (!empty($this->request->data)) {
                if (!empty($this->request->data['organization_officer_photo']['name'])) {
                    $file = $this->request->data['organization_officer_photo']; //put the data into a var for easy use

                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                    $arr_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions
                    $setNewFileName = time() . "_" . rand(000000, 999999);

                    //only process if the extension is valid
                    if (in_array($ext, $arr_ext)) {
                        //do the actual uploading of the file. First arg is the tmp name, second arg is 
                        //where we are putting it
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/upload/' . $setNewFileName . '.' . $ext);

                        //prepare the filename for database entry 
                        $imageFileName = $setNewFileName . '.' . $ext;
                        }
                    }
                    else {
                        $imageFileName = $organization_officer->organization_officer_photo;
                    }


            $officersTable = TableRegistry::get('OrganizationOfficers');

            $officersTable = TableRegistry::getTableLocator()->get('OrganizationOfficers');
            $officers = $officersTable->get($organization_officer_id);

            $officers->organization_officer_name = $this->request->data['organization_officer_name'];
            $officers->organization_id = $this->request->data['organization_id'];
            $officers->officers_position_id = $this->request->data['officers_position_id'];
            $officers->organization_officer_photo = $imageFileName;

                    if (!empty($this->request->data['organization_officer_photo']['name'])) {
                        $officers->employee_photo = $imageFileName;
                    }

            }

            if ($officersTable->save($officers)) {
                $this->Flash->success(__('Your article has been saved.'));
                return $this->redirect(['action' => 'edit', $organization_officer_id]);
            }
            else {
                debug($officers->errors());
            }
            
            $this->Flash->error(__('Unable to add your article.'));
        }
        // Get a list of tags.

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