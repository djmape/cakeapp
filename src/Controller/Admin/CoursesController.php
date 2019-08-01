<?php
// src/Controller/AdminController.php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class CoursesController extends AppController
{
    public function sideBar() {

        $this->loadModel('Users');
        $users =  $this->Users->find('all')->where(['Users.id' => $this->Auth->user('id')]);
        $users = $users->first(); 
        $this->set(compact('users', $users));
        $this->log($users->email,'debug');
    }

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
        $this->Auth->allow(['tags']);
        $this->sideBar();
        $this->adminSideBarHasSub('courses');
        $this->adminSideBar('');
    }

    public function index()
    {
        $this->adminSideBar('all');
        $courses = $this->Paginator->paginate($this->Courses->find('all')->where(['Courses.active' => 1]));
        $this->set(compact('courses'));
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
        $this->adminSideBar('add');
        $this->loadModel('Organizations');
        $organizations =  $this->Organizations->find('list', ['keyField' => 'organization_id', 'valueField' => 'organization_name']);
        $this->set('organizations', $organizations);

        $course = $this->Courses->newEntity();
        if ($this->request->is('post')) {
            
            $course->course_name = $this->request->data['course_name'];
            $course->course_acronym = $this->request->data['course_acronym'];
            $course->organization_id = $this->request->data['organization_id'];
            $course->course_mission = $this->request->data['course_mission'];
            $course->course_vision = $this->request->data['course_vision'];
            $course->course_goal = $this->request->data['course_goal'];
            $course->course_objective = $this->request->data['course_objective'];
            $course->course_type = $this->request->data['course_type'];
            $course->active = 1;

            if ($saved = $this->Courses->save($course)) {
                $this->Flash->success('Course Added!', [
                    'params' => [
                        'saves' => 'Course Added!'
                        ]
                    ]);
                return $this->redirect(['action' => 'edit', $saved]);
            }
            else {
                $this->Flash->error(__('Unable to add course.'));
            }
        }
        $this->set('course',$course);
    }
    
    public function edit($course_id)
    {
        $this->loadModel('Organizations');
        $organizations =  $this->Organizations->find('list', ['keyField' => 'organization_id', 'valueField' => 'organization_name']);
        $this->set('organizations', $organizations);

        $course = $this->Courses->find('all', 
                   array('conditions'=>array('Courses.course_id'=>$course_id)));

        $row = $course->first();
        
        if ($this->request->is(['post', 'put'])) {
                $coursesTable = TableRegistry::get('Courses');

                $coursesTable = TableRegistry::getTableLocator()->get('Courses');
                $course = $coursesTable->get($course_id);

                $course->course_name = $this->request->data['course_name'];
                $course->course_acronym = $this->request->data['course_acronym'];
                $course->organization_id = $this->request->data['organization_id'];
                $course->course_mission = $this->request->data['course_mission'];
                $course->course_vision = $this->request->data['course_vision'];
                $course->course_goal = $this->request->data['course_goal'];
                $course->course_objective = $this->request->data['course_objective'];
                $course->course_type = $this->request->data['course_type'];

            if ($coursesTable->save($course)) {
                $this->Flash->success('Course Updated!', [
                    'params' => [
                        'saves' => 'Course Updated!'
                        ]
                    ]);
                return $this->redirect(['action' => 'edit', $course_id]);
            }
            else {
                $this->Flash->error(__('Unable to update course.'));
            }
        }

        $this->set('course', $course);
        $this->set('row', $row);
    }

    public function delete()
    {   
        $this->layout = false;
        $this->autoRender = false;

        if ($this->request->is(['post', 'put'])) {

            $course_id = $this->request->getData('course_id');

            $coursesTable = TableRegistry::get('Courses');

            $coursesTable = TableRegistry::getTableLocator()->get('Courses');
            $course = $coursesTable->get($course_id);

            $course->active = 0;

            if ($this->Courses->save($course)) {
                $this->Flash->success('Course Removed!', [
                    'params' => [
                        'saves' => 'Course Removed!'
                        ]
                    ]);
            }
            else {
                $this->Flash->error(__('Unable to delete course.'));
            }
            
        }
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
        if (in_array($action, ['add', 'edit','index','delete'])) {
            return true;
        }
    }

    public function announcement()
    {
        $this->loadComponent('Paginator');
        $articles = $this->Paginator->paginate($this->Articles->find()->where(['Articles.status' => 1]));
        $this->set(compact('articles'));
    }

    function navBar() {
        $this->loadModel('Courses');
        $course =  $this->Courses->find('all');
        $this->set(compact('course', $course));
    }

}