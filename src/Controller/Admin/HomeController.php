<?php
// src/Controller/AdminController.php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class HomeController extends AppController
{
    
    public function initialize()
    {   
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash');
        $this->updateEventStatus();
        $this->adminHeaderSidebar('home');
        $this->adminSideBarHasSub('site-info');
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
                $home_carousel_img->home_carousel_img_caption = $this->request->getData('image_caption');
                $home_carousel_img->home_carousel_img_description = $this->request->getData('image_description');
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


    public function edit($home_carousel_img_id)
    {
        $this->loadModel('HomeCarouselImgs');
        $home_carousel_img = $this->HomeCarouselImgs->newEntity();

        $home_carousel_imgs = $this->paginate($this->HomeCarouselImgs->find('all')->where(['HomeCarouselImgs.home_carousel_img_id' => $home_carousel_img_id]));
        $home_carousel_imgs = $home_carousel_imgs->first();
        $this->set('home_carousel_imgs', $home_carousel_imgs);


        if ($this->request->is(['post', 'put'])) {

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
                        $imageFileName = $home_carousel_imgs->home_carousel_img_name;
                    }

            $homeImagesTable = TableRegistry::get('HomeCarouselImgs');

            $homeImagesTable = TableRegistry::getTableLocator()->get('HomeCarouselImgs');
            $home_carousel_img = $homeImagesTable->get($home_carousel_img_id);

                $home_carousel_img->home_carousel_img_name = $imageFileName;
                $home_carousel_img->home_carousel_img_caption = $this->request->getData('image_caption');
                $home_carousel_img->home_carousel_img_description = $this->request->getData('image_description');
                $home_carousel_img->visibilty = 1;

            }

            if ($homeImagesTable->save($home_carousel_img)) {
                $this->Flash->success('Image Updated!', [
                    'params' => [
                        'saves' => 'Image Updated!'
                        ]
                    ]);
                return $this->redirect(['action' => 'edit', $home_carousel_img_id]);
            }
            else {
                debug($event->errors());
                $this->Flash->error(__('Unable to add your article.'));
            }
            
        }
    }
    
    public function hide()
    {   
        $this->layout = false;
        $this->autoRender = false;

        $this->loadModel('HomeCarouselImgs');

        if ($this->request->is(['post', 'put'])) {

            $home_carousel_img_id = $this->request->getData('home_carousel_img_id');

            $homeCarouselImgsTable = TableRegistry::get('HomeCarouselImgs');

            $homeCarouselImgsTable = TableRegistry::getTableLocator()->get('HomeCarouselImgs');
            $home_carousel_img = $homeCarouselImgsTable->get($home_carousel_img_id);

            $home_carousel_img->visibility = 0;

            if ($this->HomeCarouselImgs->save($home_carousel_img)) {
                $this->Flash->success('Image Hid!', [
                    'params' => [
                        'saves' => 'Image Hid!'
                        ]
                    ]);
            }
            else {
                debug($number->errors());
                $this->Flash->error(__('Unable to add your article.'));
            }
        }
    }
    
    public function unhide()
    {   
        $this->layout = false;
        $this->autoRender = false;

        $this->loadModel('HomeCarouselImgs');

        if ($this->request->is(['post', 'put'])) {

            $home_carousel_img_id = $this->request->getData('home_carousel_img_id');

            $homeCarouselImgsTable = TableRegistry::get('HomeCarouselImgs');

            $homeCarouselImgsTable = TableRegistry::getTableLocator()->get('HomeCarouselImgs');
            $home_carousel_img = $homeCarouselImgsTable->get($home_carousel_img_id);

            $home_carousel_img->visibility = 1;

            if ($this->HomeCarouselImgs->save($home_carousel_img)) {
                $this->Flash->success('Image Unhidden!', [
                    'params' => [
                        'saves' => 'Image Unhidden!'
                        ]
                    ]);
            }
            else {
                debug($number->errors());
                $this->Flash->error(__('Unable to add your article.'));
            }
        }
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
        if (in_array($action, ['index','delete','edit','hide','unhide'])) {
            return true;
        }

    }

}