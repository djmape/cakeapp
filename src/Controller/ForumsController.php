<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Mailer\Email;
use App\Form\EmailForm;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ForumsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->adminSideBarHasSub('users');
        $this->navBar('');
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function forumHome()
    {   
        $this->header();
        $this->title('PUPQC | Forum Home');

        $this->loadModel('Posts');
        $this->loadModel('Announcements');
        $this->loadModel('Users');
        $this->loadModel('UserProfiles');

        $paginate = ['sortWhitelist' => 'Posts.post_modified'];
        $posts = $this->paginate($this->Posts->find('all')->contain(['Users.UserProfiles','Announcements'])->where(['Posts.post_active' => 1]));
        $this->log($posts->first(),'debug');
        $this->set(compact('posts'));
    }

    public function forumCategories()
    {   
        $this->header();
        $this->title('PUPQC | Forum Categories');

        $this->loadModel('Posts');
        $this->loadModel('Announcements');
        $this->loadModel('Users');
        $this->loadModel('UserProfiles');

        $paginate = ['sortWhitelist' => 'Posts.post_modified'];
        $posts = $this->paginate($this->Posts->find('all')->contain(['Users.UserProfiles','Announcements'])->where(['Posts.post_active' => 1]));
        $this->log($posts->first(),'debug');
        $this->set(compact('posts'));
    }

    public function forumTopics()
    {   
        $this->header();
        $this->title('PUPQC | Forum Topics');

        $this->loadModel('Posts');
        $this->loadModel('Announcements');
        $this->loadModel('Users');
        $this->loadModel('UserProfiles');

        $paginate = ['sortWhitelist' => 'Posts.post_modified'];
        $posts = $this->paginate($this->Posts->find('all')->contain(['Users.UserProfiles','Announcements'])->where(['Posts.post_active' => 1]));
        $this->log($posts->first(),'debug');
        $this->set(compact('posts'));
    }

    public function forumDiscussions()
    {   
        $this->header();
        $this->title('PUPQC | Forum Discussions');

        $this->loadModel('Posts');
        $this->loadModel('Announcements');
        $this->loadModel('Users');
        $this->loadModel('UserProfiles');

        $paginate = ['sortWhitelist' => 'Posts.post_modified'];
        $posts = $this->paginate($this->Posts->find('all')->contain(['Users.UserProfiles','Announcements'])->where(['Posts.post_active' => 1]));
        $this->log($posts->first(),'debug');
        $this->set(compact('posts'));
    }

    public function forumReplies()
    {   
        $this->header();
        $this->title('PUPQC | Forum Discussions');

        $this->loadModel('Posts');
        $this->loadModel('Announcements');
        $this->loadModel('Users');
        $this->loadModel('UserProfiles');

        $paginate = ['sortWhitelist' => 'Posts.post_modified'];
        $posts = $this->paginate($this->Posts->find('all')->contain(['Users.UserProfiles','Announcements'])->where(['Posts.post_active' => 1]));
        $this->log($posts->first(),'debug');
        $this->set(compact('posts'));
    }

    public function changePassword() {
        $this->adminProfileSideBar('password');

        $user = $this->Users->find('all')->where(['Users.id'=>$this->Auth->user('id')]);
        $this->set('user',$user);
        $row = $user->first();

        if ($this->request->is(['post', 'put'])) {

            $usersTable = TableRegistry::get('Users');

            $usersTable = TableRegistry::getTableLocator()->get('Users');
            $users = $usersTable->get($this->Auth->user('id'));

            $current_password = $this->request->data['current_password'];

            if ((new DefaultPasswordHasher)->check($current_password, $users->password)) {

                $users->password = $this->request->data['new_password'];

                 if ($usersTable->save($users)) {
                    $this->Flash->success('User Updated!', [
                    'params' => [
                        'saves' => 'Password Updated!'
                        ]
                    ]);
                return $this->redirect(['action' => 'changePassword', $this->Auth->user('id')]);
                }
                else {
                debug($event->errors());
                $this->Flash->error(__('Unable to add your article.'));
                }
            }
            else {
                    $this->Flash->error('incorrect Password', [
                    'params' => [
                        'saves' => 'incorrect Password!'
                        ]
                    ]);
            }
      }      
        $this->set('user',$user);
    }


    public function isAuthorized($user) {

    if (in_array($this->request->action, ['forumHome', 'forumCategories','forumTopics','forumDiscussions','forumReplies','register','adminAll','adminAdd','adminEdit','adminDelete','employeesAll','employeeAdd','employeeEdit','studentsAll','studentAdd','studentEdit','alumniAll','alumniAdd','alumniEdit','deleteUser','logout'])) {
        return true;
    }

        return parent::isAuthorized($user);
    }
}
