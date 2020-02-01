<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Controller\Component\FlashComponent;
use Cake\View\Helper;
use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    #public $helpers = array('Froala.Froala');
    public $helpers = ['CkEditor.Ck'];

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->paginate = [ 'limit' => '1000', 'maxLimit' => '1000' ];
        $this->loadComponent('Flash');
        $this->footer();

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');

        $this->loadComponent('Auth', [
            'authorize'=> 'Controller',
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'email',
                        'password' => 'password'
                    ]
                ]
            ],
            'authError' => 'Incorrect!'
            ,
            'loginAction' => [
                'prefix' => false,
                'controller' => 'Users',
                'action' => 'login'
            ],
            'loginRedirect' => [
                'prefix' => false,
                'controller' => 'Users', 
                'action' => 'index'
            ],
             // If unauthorized, return them to page they were just on
            'unauthorizedRedirect' => [
                'prefix' => 'front',
                'controller' => 'abouts',
                'action' => 'index']
        ]);

        // Allow the display action so our PagesController
        // continues to work. Also enable the read only actions.
         #$this->Auth->allow();
        #if (prefix != 'admin') {
         #   $this->Auth->allow () ;
        #}
        if (empty($this->request->params['prefix']) || $this->request->params['prefix'] !== 'admin') {
            $this->Auth->allow (['index', 'view', 'display']) ;
        }

        $this->set('login_status', false);

        

        $this->userSettings(false);
    }

    public function checkLoginStatus() {
        if ($this->Auth->user()) {
            $this->set('login_status', true);
            $this->header();
        }
        else {
            $this->set('login_status', false);
        }
    }

    public function isAuthorized($user)
    {
        // By default deny access.
        return false;

        if (prefix != 'admin') {
            $this->Auth->allow () ;
        }

        $this->userSettings(true);
        $this->header();
    }

    public function header() {

        $this->loadModel('Users');
        $this->loadModel('UserTypes');
        $this->loadModel('User_Profiles');

        $getProfile = $this->User_Profiles->find('all')->where(['User_Profiles.user_profile_user_id' => $this->Auth->user('id')])->first();
        $this->set('profile',$getProfile);

        $user_type = $this->Users->find('all')->contain(["UserTypes"])->where(['Users.id' => $this->Auth->user('id')])->first();
        $this->userHeader();
    }

    public function navBar($active) {
        $this->loadModel('Courses');
        $courses =  $this->Courses->find('all')->where(['Courses.active' => 1]);
        $this->set(compact('courses', $courses));
        $this->loadModel('Organizations');
        $organizations =  $this->Organizations->find('all')->where(['Organizations.active' => 1])->where(['Organizations.organization_id' != 1]);
        $this->set(compact('organizations', $organizations));
        $this->loadModel('Offices');
        $offices =  $this->Offices->find('all')->where(['Offices.active' => 1]);
        $this->set(compact('offices', $offices));
        $this->set('active', $active);
    }

    public function adminHeaderSidebar($active) {
        $this->set('active', $active);
    }

    public function adminProfileSideBar($active) {
        $this->set('active', $active);
    }

    public function userSettingsSidebar($active) {
        $this->set('active', $active);
    }

    public function adminSideBarHasSub($expand) {
        $this->set('expand', $expand);
    }

    public function userSettings($user_settings) {
        $this->set('user_settings', false);
    }

    public function footer() {
        $this->loadModel('ContactEmails');
        $emails =  $this->ContactEmails->find('all')->where(['ContactEmails.active' => 1]);
        $this->set('emails', $emails);
        $this->loadModel('ContactNumbers');
        $numbers =  $this->ContactNumbers->find('all')->where(['ContactNumbers.active' => 1]);
        $this->set('numbers', $numbers);
        $this->set('margin', 'true');
    }


    public function updateEventStatus() {
        // Update to get  events that are not past yet
        $this->loadModel('Events');
        $events = $this->Events->find('all');

        $now = Time::now();
        $dateNow = $now->format('Y-m-d');
        $timeNow = $now->format('h:i A'); 
        $date_time_now = strtotime("$dateNow $timeNow");
        $this->log($date_time_now ,'debug');

        foreach ($events as $event) {
            
            $this->log($event->event_id ,'debug');
            $event_start_date = $event->event_start_date;
            $event_start_time = $event->event_start_time;
            $event_start_date = $event_start_date->format('Y-m-d');
            $event_start_time = $event_start_time->format('h:i A');
            $event_start_date_time = strtotime("$event_start_date $event_start_time");

            $event_end_date = $event->event_end_date;
            $event_end_time = $event->event_end_time;
            $event_end_date = $event_end_date->format('Y-m-d');
            $event_end_time = $event_end_time->format('h:i A');
            $event_end_date_time = strtotime("$event_end_date $event_end_time");

            // if event is less that now()
            if( $event_start_date_time >= $date_time_now ) {
                $this->log('Upcoming','debug');
                $event_status = 'Upcoming';
            }
            //
            else if( $event_start_date_time <= $date_time_now AND $event_end_date_time > $date_time_now) {
                $event_status = 'Ongoing';
            }
            else if( $event_start_date_time < $date_time_now AND $event_end_date_time < $date_time_now) {
                $event_status = 'Past';
            }
            else {
                $this->log('Indecipherable','debug');  
                $event_status = 'Pasts';              
            }

            $event_id_current = $event->event_id;
            $eventsTable = TableRegistry::get('Events');

            $eventsTable = TableRegistry::getTableLocator()->get('Events');
            $eventStatusUpdate = $eventsTable->get($event->event_id);

            $eventStatusUpdate->event_status = $event_status;

            $eventsTable->save($eventStatusUpdate);
        }
    }

    public function title($title) {
        $this->set('title', $title);
    }

    public function checkUserRole($role) {
        $this->set('role', $role);
    }

    public function userHeader() {

        $this->loadModel("Users");
        $this->loadModel("User_Types");

        $user_type = $this->Users->find('all')->contain(["UserTypes"])->where(['Users.id' => $this->Auth->user('id')])->first();

        if ($user_type->user_type->user_type_name == 'Administrator') {

            $this->loadModel("User_Administrators");

            $user = $this->User_Administrators->find('all')->contain(['Users'])->where(['User_Administrators.user_id' => $this->Auth->user('id')]);

            $this->set('user',$user->first());
            $this->set('user_type','Administrator');

            $fullname = $user->first()->admin_lastname . ', ' . $user->first()->admin_lastname . ' ' .substr($user->first()->admin_middlename,0 ,1) . '.';
            $this->title('PUPQC Web Portal | ' . $fullname);
        }
        else if ($user_type->user_type->user_type_name == 'Employee') {

            $this->loadModel("User_Employees");
            $this->loadModel("EmployeePositionNames");

            $user = $this->User_Employees->find('all')->contain(["Users.UserTypes","EmployeePositionNames"])->innerJoinWith("EmployeePositionNames")->where(['User_Employees.user_id' => $this->Auth->user('id')]);

            $this->set('user',$user->first());
            $this->set('user_type','Employee');

            $fullname = $user->first()->user_employee_lastname . ', ' . $user->first()->user_employee_firstname . ' ' .substr($user->first()->user_employee_middlename,0 ,1) . '.';
            $this->title('PUPQC Web Portal | ' . $fullname);
        }
        else if ($user_type->user_type->user_type_name == 'Student') {

            $this->loadModel("User_Students");

            $user = $this->User_Students->find('all')->contain(["Users.UserTypes"])->where(['User_Students.user_id' => $this->Auth->user('id')]);

            $this->set('user',$user->first());
            $this->set('user_type','Student');

            $fullname = $user->first()->user_student_lastname . ', ' . $user->first()->user_student_firstname . ' ' . substr($user->first()->user_student_middlename,0 ,1) . '.';
            $this->title('PUPQC Web Portal | ' . $fullname);
        }
        else if ($user_type->user_type->user_type_name == 'Alumni') {

            $this->loadModel("User_Alumni");

            $user = $this->User_Alumni->find('all')->contain(["Users.UserTypes"])->where(['User_Alumni.user_id' => $this->Auth->user('id')]);
            
            $this->set('user',$user->first());
            $this->set('user_type','Alumni');

            $fullname = $user->first()->user_alumni_lastname .', '. $user->first()->user_alumni_firstname . ' ' . substr($user->first()->user_alumni_middlename,0 ,1) . '.';
            $this->title('PUPQC Web Portal | ' . $fullname);
        }
    }
}
