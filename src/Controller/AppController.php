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
                'prefix' => 'admin',
                'controller' => 'Users',
                'action' => 'login'
            ],
            'loginRedirect' => [
                'prefix' => 'admin',
                'controller' => 'Home', 
                'action' => 'index'
            ],
             // If unauthorized, return them to page they were just on
            'unauthorizedRedirect' => $this->referer()
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

    }

    public function isAuthorized($user)
    {
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }
        // By default deny access.
        return false;


        if (prefix != 'admin') {
            $this->Auth->allow () ;
        }
    }

    public function navBar() {
        $this->loadModel('Courses');
        $courses =  $this->Courses->find('all')->where(['Courses.active' => 1]);
        $this->set(compact('courses', $courses));
        $this->loadModel('Organizations');
        $organizations =  $this->Organizations->find('all')->where(['Organizations.active' => 1]);
        $this->set(compact('organizations', $organizations));
        $this->loadModel('Offices');
        $offices =  $this->Offices->find('all')->where(['Offices.active' => 1]);
        $this->set(compact('offices', $offices));
    }

    public function adminSideBar($active) {
        $this->set('active', $active);
    }

    public function adminProfileSideBar($active) {
        $this->set('active', $active);
    }

    public function adminSideBarHasSub($expand) {
        $this->set('expand', $expand);
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
            $this->log($event_start_date_time ,'debug');

            $event_end_date = $event->event_end_date;
            $event_end_time = $event->event_end_time;
            $event_end_date = $event_end_date->format('Y-m-d');
            $event_end_time = $event_end_time->format('h:i A');
            $event_end_date_time = strtotime("$event_end_date $event_end_time");
            $this->log($event_end_date_time ,'debug');

            // if event is less that now()
            if( $event_start_date_time >= $date_time_now ) {
                $this->log('Upcoming','debug');
                $event_status = 'Upcoming';
            }
            //
            else if( $event_start_date_time <= $date_time_now AND $event_end_date_time > $date_time_now) {
                $this->log('Ongoing','debug');
                $event_status = 'Ongoing';
            }
            else if( $event_start_date_time < $date_time_now AND $event_end_date_time < $date_time_now) {
                $this->log('Past','debug');
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
}
