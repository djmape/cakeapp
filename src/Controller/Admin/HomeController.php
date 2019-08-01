<?php
// src/Controller/AdminController.php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class HomeController extends AppController
{
    #public $helpers = array('TinyMCE.TinyMCE');
    
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
        $this->loadComponent('Flash');
        $this->sideBar(); 
        $this->adminSideBar('home');
        $this->adminSideBarHasSub('');
    }

    public function index()
    {
        $this->loadModel('HomeCarouselImgs');
        $home_carousel_img = $this->HomeCarouselImgs->newEntity();

        $home_carousel_imgs = $this->paginate($this->HomeCarouselImgs->find('all')->where(['HomeCarouselImgs.active' => 1]));
        $this->set(compact('home_carousel_imgs'));

        $this->set('home_carousel_img', $home_carousel_img);

        if ($this->request->is('post')) {

            if (!empty($this->request->data)) {
                if (!empty($this->request->data['home_carousel_img_name']['name'])) {
                    $file = $this->request->data['home_carousel_img_name']; //put the data into a var for easy use

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
                        $imageFileName = 'default.png';
                    }

                $home_carousel_img->home_carousel_img_name = $imageFileName;
                $home_carousel_img->active = 1;

            }

            if ($saved = $this->HomeCarouselImgs->save($home_carousel_img)) {
                return $this->redirect(['action' => 'index']);
            }
            else {
                debug($event->errors());
                $this->Flash->error(__('Unable to add your article.'));
            }
            
        }
    }

    public function view($slug = null)
	{
        $this->loadModel('Articles');
        $article = $this->Articles->findBySlug($slug)->contain(['Tags'])->firstOrFail();
    	$this->set(compact('article'));
	}

    public function add()
    {
        
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
    
    public function delete()
    {   
        $this->layout = false;
        $this->autoRender = false;

        $this->loadModel('HomeCarouselImgs');

        if ($this->request->is(['post', 'put'])) {

            $home_carousel_img_id = $this->request->getData('home_carousel_img_id');

            $homeCarouselImgsTable = TableRegistry::get('HomeCarouselImgs');

            $homeCarouselImgsTable = TableRegistry::getTableLocator()->get('HomeCarouselImgs');
            $home_carousel_img = $homeCarouselImgsTable->get($home_carousel_img_id);

            $home_carousel_img->active = 0;

            if ($this->HomeCarouselImgs->save($home_carousel_img)) {
                $this->Flash->success('Image Deleted!', [
                    'params' => [
                        'saves' => 'Image Deleted!'
                        ]
                    ]);
            }
            else {
                debug($number->errors());
                $this->Flash->error(__('Unable to add your article.'));
            }
        }
    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        // The add and tags actions are always allowed to logged in users.
        if (in_array($action, ['index','delete'])) {
            return true;
        }

    }

}