<?php
// src/Controller/AdminController.php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

class EventsController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
        $this->updateEventStatus();
        $this->adminSideBarHasSub('posts');
        $this->adminHeaderSideBar('events');
    }

    public function index()
    {
        $this->title('Admin | Events');

        $this->updateEventStatus();
        $event = $this->Paginator->paginate($this->Events->find('all', array(
        'order'=>array('FIELD(Events.event_status,"Ongoing","Upcoming","Past") ASC')))->where(['Events.active' => 1]));
        $this->set(compact('event'));
    }

    public function add()
    {   
        $this->title('Admin | Add Event');
        $event = $this->Events->newEntity();
        if ($this->request->is('post')) {

            if (!empty($this->request->data)) {
                if (!empty($this->request->data['event_photo']['name'])) {
                    $file = $this->request->data['event_photo']; //put the data into a var for easy use

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
                        $imageFileName = '';
                    }

                $event_start_date = date('Y-m-d', strtotime($this->request->data['event_start_date']));
                $event_start_time = date('H:i:s', strtotime($this->request->data['event_start_time']));
                $event_end_date = date('Y-m-d', strtotime($this->request->data['event_end_date']));
                $event_end_time = date('H:i:s', strtotime($this->request->data['event_end_time']));

                $event->event_title = $this->request->data['event_title'];
                $event->event_body = $this->request->data['event_body'];
                $event->event_created = Time::now();;
                $event->event_modified = Time::now();;
                $event->event_start_date = $event_start_date;
                $event->event_start_time = $event_start_time;
                $event->event_end_date = $event_end_date;
                $event->event_end_time = $event_end_time;
                $event->event_sponsors = $this->request->data['event_sponsors'];
                $event->event_participants = $this->request->data['event_participants'];
                $event->event_location = $this->request->data['event_location'];
                //$event->event_location_embed = $this->request->data['event_location_embed'];
                $event->event_status = '';
                $event->event_photo = $imageFileName;
                $event->active = 1;

            }

            if ($saved  =$this->Events->save($event)) {
                $this->Flash->success('Event Added!', [
                    'params' => [
                        'saves' => 'Event Added!'
                        ]
                    ]);
                return $this->redirect(['action' => 'index']);
            }
            else {
                debug($event->errors());
            }
            
            $this->Flash->error(__('Unable to add your article.'));
        }
        // Get a list of tags.
        $this->log($event,'debug');
        $this->set('event', $event);
    }
    
    public function edit($event_id)
    {
        $this->title('Admin | Edit Event');
        $event = $this->Events->find('all', 
                   array('conditions'=>array('Events.event_id'=>$event_id)));

        $row = $event->first();
        $row->event_start_time = $row->event_start_time->format('h:i A');
        $row->event_end_time = $row->event_end_time->format('h:i A');
        
        if ($this->request->is(['post', 'put'])) {

            if (!empty($this->request->data)) {
                if (!empty($this->request->data['event_photo']['name'])) {
                    $file = $this->request->data['event_photo']; //put the data into a var for easy use

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
                        $imageFileName =  $row->event_photo;
                    }

            }

            $eventsTable = TableRegistry::get('Events');

            $eventsTable = TableRegistry::getTableLocator()->get('Events');
            $event = $eventsTable->get($event_id);



                $event_start_date = date('Y-m-d', strtotime($this->request->data['event_start_date']));
                $event_start_time = date('H:i:s', strtotime($this->request->data['event_start_time']));
                $event_end_date = date('Y-m-d', strtotime($this->request->data['event_end_date']));
                $event_end_time = date('H:i:s', strtotime($this->request->data['event_end_time']));

                $event->event_title = $this->request->data['event_title'];
                $event->event_body = $this->request->data['event_body'];
                $event->event_modified = Time::now();;
                $event->event_start_date = $event_start_date;
                $event->event_start_time = $event_start_time;
                $event->event_end_date = $event_end_date;
                $event->event_end_time = $event_end_time;
                $event->event_sponsors = $this->request->data['event_sponsors'];
                $event->event_participants = $this->request->data['event_participants'];
                $event->event_location = $this->request->data['event_location'];
                //$event->event_location_embed = $this->request->data['event_location_embed'];
                $event->event_photo = $imageFileName;


            if ($eventsTable->save($event)) {
                $this->Flash->success('Event Updated!', [
                    'params' => [
                        'saves' => 'Event Updated!'
                        ]
                    ]);
                return $this->redirect(['action' => 'index']);
            }
            else {
                $this->Flash->error(__('Unable to update your event.'));
            }
        }

        $this->set('event', $event);
        $this->set('row', $row);
    }

    
    public function delete()
    {   
        $this->layout = false;
        $this->autoRender = false;

        if ($this->request->is(['post', 'put'])) {

            $event_id = $this->request->getData('event_id');

            $eventsTable = TableRegistry::get('Events');

            $eventsTable = TableRegistry::getTableLocator()->get('Events');
            $event = $eventsTable->get($event_id);

            $event->active = 0;

            if ($this->Events->save($event)) {
                $this->Flash->success('Event Deleted!', [
                    'params' => [
                        'saves' => 'Event Deleted!'
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
        if (in_array($action, ['add', 'edit','index','delete'])) {
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

}