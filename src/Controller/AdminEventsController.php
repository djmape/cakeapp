<?php
// src/Controller/AdminEventsController.php

namespace App\Controller;

class AdminEventsController extends AppController
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
        $this->loadModel('Events');
        $events = $this->Paginator->paginate($this->Events->find()->where(['Events.status' => 1]));
        $this->set(compact('events'));
    }

    public function view($slug = null)
	{
        $event = $this->Events->findBySlug($slug)->contain(['Tags'])->firstOrFail();
    	$this->set(compact('event'));
	}

    public function add()
    {
        $this->loadModel('Events');
        $event = $this->Events->newEntity();
        if ($this->request->is('post')) {
            $event = $this->Events->patchEntity($event, $this->request->getData());

            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            $event->user_id = $this->Auth->user('id');
            $event->status = 1;

            if ($this->Events->save($event)) {
                $this->Flash->success(__('Your event has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your event.'));
        }
        // Get a list of tags.
        $tags = $this->Events->Tags->find('list');

        // Set tags to the view context
        $this->set('tags', $tags);
        $this->set('event', $event);
    }
    public function edit($slug)
    {
        $event = $this->Events->findBySlug($slug)->contain('Tags')->firstOrFail();
        if ($this->request->is(['post', 'put'])) {
            $this->Events->patchEntity($event, $this->request->getData(), [
            'accessibleFields' => ['user_id' => false]
        ]);
            if ($this->Events->save($event)) {
                $this->Flash->success(__('Your event has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your event.'));
        }
        // Get a list of tags.
        $tags = $this->Events->Tags->find('list');

        // Set tags to the view context
        $this->set('tags', $tags);

        $this->set('event', $event);
    }

    public function delete($slug)
    {
        $event = $this->Events->findBySlug($slug)->firstOrFail();
        if ($this->request->is(['post', 'put'])) {
            $event->status = 0;
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The {0} event has been deleted.', $event->title));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to delete your event.'));
        }
        $this->set('event', $event);
    }

    public function tags()
    {
        // The 'pass' key is provided by CakePHP and contains all
        // the passed URL path segments in the request.
        $tags = $this->request->getParam('pass');

        // Use the EventsTable to find tagged events.
        $events = $this->Events->find('tagged', [
            'tags' => $tags
        ]);

        // Pass variables into the view template context.
        $this->set([
            'events' => $events,
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

        // All other actions require a slug.
        $slug = $this->request->getParam('pass.0');
        if (!$slug) {
            return false;
        }

        // Check that the event belongs to the current user.
        $event = $this->Events->findBySlug($slug)->first();

        return $event->user_id === $user['id'];
    }

    public function announcement()
    {
        $this->loadComponent('Paginator');
        $events = $this->Paginator->paginate($this->Events->find()->where(['Events.status' => 1]));
        $this->set(compact('events'));
    }
}