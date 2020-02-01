<?php
// src/Controller/AdminController.php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class CoursesController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
        $this->Auth->allow(['tags']);
        $this->adminSideBarHasSub('students');
        $this->adminHeaderSideBar('courses');
    }

    public function index()
    {
        $this->title('Admin | Courses');
        $courses = $this->Paginator->paginate($this->Courses->find('all')->where(['Courses.active' => 1]));
        $this->set(compact('courses'));
    }

    public function add()
    {   
        $organizations_count = 1;

        $this->title('Admin | Add Course');

        $this->loadModel('Organizations');
        $organizations =  $this->Organizations->find('list', ['keyField' => 'organization_id', 'valueField' => 'organization_name'])->where(["Organizations.active"=>1]);
        $this->set('organizations', $organizations);

        if ($organizations->count() == 0) {
            $this->log($organizations->count(). ' zero','debug');
            $organizations_count = 0;
        }
        else {
            $this->set('organizations', $organizations);
        }

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
            $course->other_info = $this->request->data['other_info'];
            $course->active = 1;

            if ($saved = $this->Courses->save($course)) {
                $this->Flash->success('Course Added!', [
                    'params' => [
                        'saves' => 'Course Added!'
                        ]
                    ]);
                return $this->redirect(['action' => 'index']);
            }
            else {
                $this->Flash->error('Course Added!', [
                    'params' => [
                        'saves' => 'Course Added!'
                        ]
                    ]);
            }
        }
        $this->set('course',$course);

        // checks if there are available organizations
        $this->set('organizations_count', $organizations_count);
    }
    
    public function edit($course_id)
    {
        $organizations_count = 1;

        $this->title('Admin | Edit Course'); 
        $this->loadModel('Organizations');
        $organizations =  $this->Organizations->find('list', ['keyField' => 'organization_id', 'valueField' => 'organization_name'])->where(["Organizations.active"=>1]);
        $this->set('organizations', $organizations);

        if ($organizations->count() == 0) {
            $this->log($organizations->count(). ' zero','debug');
            $organizations_count = 0;
        }
        else {
            $this->set('organizations', $organizations);
        }

        $course = $this->Courses->find('all', 
                   array('conditions'=>array('Courses.course_id'=>$course_id)))->contain(['Organizations']);

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
                $course->other_info = $this->request->data['other_info'];

            if ($coursesTable->save($course)) {
                $this->Flash->success('Course Updated!', [
                    'params' => [
                        'saves' => 'Course Updated!'
                        ]
                    ]);
                return $this->redirect(['action' => 'index']);
            }
            else {
                $this->Flash->error(__('Unable to update course.'));
            }
        }

        $this->set('course', $course);
        $this->set('row', $row);

        // checks if there are available organizations
        $this->set('organizations_count', $organizations_count);
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

}