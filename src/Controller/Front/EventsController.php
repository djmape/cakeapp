<?php
// src/Controller/AdminController.php

namespace App\Controller\Front;

use App\Controller\AppController;
use Cake\I18n\Date;
use Cake\I18n\Time;

class EventsController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
        $this->Auth->allow(['index']);
        $this->navBar();
        $this->adminSideBar('events');
    }

    public function index($event_status)
    {
        $this->loadModel('Events');
        $this->updateEventStatus();

        if ($this->request->is(['post', 'put'])) {
        $this->log('Passed','debug');
            $event_status = $this->request->getData('event_status');
            return $this->redirect(['action' => 'index', $event_status]);            
        }

        if ($event_status == 'all' || $event_status == 'All') {
            $events = $this->Paginator->paginate($this->Events->find('all', array(
        'order'=>array('FIELD(Events.event_status,"Ongoing","Upcoming","Past") ASC')))->where(['Events.active' => 1]));
        }
        else {
            $events = $this->Paginator->paginate($this->Events->find('all', array('order'=>array('Events.event_end_date DESC')))->where(['Events.event_status' => $event_status])->where(['Events.active' => 1]));
        }

        foreach ($events as $event) {
            $event->event_start_date = $event->event_start_date->format('l, F d, Y');
            $event->event_start_time = $event->event_start_time->format('g:i A');
            $event->event_end_date = $event->event_end_date->format('l, F d, Y');
            $event->event_end_time = $event->event_end_time->format('g:i A');
        }

        $this->set(compact('events'));
        $this->set('event_status', $event_status);
    }

    public function view($event_id)
	{
        $this->loadModel('Events');
        $this->updateEventStatus();

        $event = $this->Events->find('all', 
                   array('conditions'=>array('Events.event_id'=>$event_id)));

        $row = $event->first();
        $row->event_start_date = $row->event_start_date->format('l, F d, Y');
        $row->event_start_time = $row->event_start_time->format('g:i A');
        $row->event_end_date = $row->event_end_date->format('l, F d, Y');
        $row->event_end_time = $row->event_end_time->format('g:i A');


        if ($this->request->is(['post', 'put'])) {
            $this->Events->patchEntity($event, $this->request->getData());
            if ($this->Events->save($event)) {
                $this->Flash->success(__('Your article has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your article.'));
        }

        $this->set('event', $event);
        $this->set('row', $row);
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

    public function filterStatus()
    {
        $this->loadModel('Events');
        $eventsFiltered = $this->Paginator->paginate($this->Events->find('all', array('order'=>array('Events.event_end_date DESC')))->where(['Events.event_status' => $event_status]));
        $this->set(compact('eventsFiltered'));

        $this->layout = false;
        $this->autoRender = false;

        if ($this->request->is(['post', 'put'])) {

            $event_status = $this->request->getData('event_status');

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
        if (in_array($action, ['add', 'tags','index','view'])) {
            return true;
        }

    }

}