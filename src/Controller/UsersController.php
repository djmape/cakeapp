<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Mailer\Email;
use App\Form\EmailForm;
use Cake\Routing\Router;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->navBar('users');
        $this->checkLoginStatus();
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {   
        $this->header();

        $this->loadModel('Posts');
        $this->loadModel('Announcements');
        $this->loadModel('Users');
        $this->loadModel('UserProfiles');

        $paginate = ['sortWhitelist' => 'Posts.post_modified'];
        $posts = $this->paginate($this->Posts->find('all')->contain(['Users.UserProfiles','Announcements'])->where(['Posts.post_active' => 1]));
        $this->log($posts->first(),'debug');
        $this->set(compact('posts'));
    }

    public function userProfile($username)
    {   
        $this->loadModel('Users');
        $currentUser = $this->Auth->user('id');
        $user_id = $this->Users->find('all')->where(['Users.username' => $username])->first()->id;

        $this->header();
        $this->loadModel('UserActivities');

        $getProfile = $this->User_Profiles->find('all')->where(['User_Profiles.user_profile_user_id' => $user_id])->first();
        $this->set('profile',$getProfile);

        $userActivities = $this->paginate($this->UserActivities->find('all')->contain(['UserPostActivities.Posts.Announcements','UserPostReactions','PostComments.PostCommentContents','ForumCategoryActivities.ForumCategories','ForumActivities.ForumTopicActivities.ForumTopics','ForumActivities.ForumDiscussionActivities.ForumDiscussions.ForumDiscussionDetails','ForumActivities.ForumReplyActivities.ForumReplies.ForumReplyDetails','ForumActivities.ForumDiscussionActivities.ForumDiscussions.ForumDiscussionDetails','ForumActivities.ForumDiscussionActivities.ForumDiscussions.ForumTopics.ForumCategories','ForumActivities.ForumTopicActivities.ForumTopics.ForumCategories','ForumCategoryActivities.ForumCategories','ForumActivities.ForumReplyActivities.ForumReplies.ForumReplyDetails','ForumActivities.ForumReplyActivities.ForumReplies.ForumDiscussions.ForumDiscussionDetails','ForumActivities.ForumReplyActivities.ForumReplies.ForumDiscussions.ForumTopics','ForumActivities.ForumReplyActivities.ForumReplies.ForumDiscussions.ForumTopics.ForumCategories','Users'])->where(['UserActivities.user_activity_user_id' => $user_id]));
        $this->log($userActivities,'debug');
        $this->set(compact('userActivities'));

        if ($currentUser == $user_id) {
            $this->set('pronoun', 'You');
        }
        else {
            $this->set('pronoun', $userActivities->first()->user->username);
        }

        
    }

    public function userSettingsProfile()
    {   
        $user_id = $this->Auth->user('id');

        $this->header();
        $this->userSettingsSidebar('profile');
        $this->title('PUPQC Web Portal | Edit Profile');   

        $this->loadModel('Users');
        $this->loadModel('User_Profiles');

        $current_user = $this->Users->find('all')->where(['Users.id' => $user_id])->first();
        $this->set('current_user',$current_user);

        $getProfile = $this->User_Profiles->find('all')->where(['User_Profiles.user_profile_user_id' => $user_id])->first();
        $this->set('profile',$getProfile);

        if ($this->request->is(['post', 'put'])) {
            if (!empty($this->request->data)) {
                if (!empty($this->request->data['user_profile_photo']['name'])) {
                    $file = $this->request->data['user_profile_photo']; //put the data into a var for easy use

                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                    $arr_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions
                    $setNewFileName = time() . "_" . rand(000000, 999999);

                    //only process if the extension is valid
                    if (in_array($ext, $arr_ext)) {
                        //do the actual uploading of the file. First arg is the tmp name, second arg is 
                        //where we are putting it
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/upload/' . $setNewFileName . '.' . $ext);

                        //prepare the filename for database entry 
                        $user_profile_photo = $setNewFileName . '.' . $ext;
                    }
                }
                else {
                    $user_profile_photo = $getProfile->user_profile_photo;
                }
                if (!empty($this->request->data['user_cover_photo']['name'])) {
                    $file = $this->request->data['user_cover_photo']; //put the data into a var for easy use

                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                    $arr_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions
                    $setNewFileName = time() . "_" . rand(000000, 999999);

                    //only process if the extension is valid
                    if (in_array($ext, $arr_ext)) {
                        //do the actual uploading of the file. First arg is the tmp name, second arg is 
                        //where we are putting it
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/upload/' . $setNewFileName . '.' . $ext);

                        //prepare the filename for database entry 
                        $user_cover_photo = $setNewFileName . '.' . $ext;
                    }
                }
                else {
                    $user_cover_photo = $getProfile->user_cover_photo;
                }

                $profilesTable = TableRegistry::get('User_Profiles');
                $profilesTable = TableRegistry::getTableLocator()->get('User_Profiles');
                $profile = $profilesTable->get($getProfile->user_profile_id);


                $profile->user_profile_photo = $user_profile_photo;
                $profile->user_cover_photo = $user_cover_photo;
                $profile->user_profile_background = '';
                $profile->user_profile_bio = $this->request->data['user_profile_bio'];
            
            }

            $confirmPassword = $this->request->data['confirm_password'];

            if ((new DefaultPasswordHasher)->check($confirmPassword, $current_user->password)) {

            if ($profilesTable->save($profile)) {
                        $this->Flash->success('User Updated!', [
                            'params' => [
                                'saves' => 'User Updated!'
                            ]
                        ]);
                        return $this->redirect(['action' => 'userSettingsProfile']);
                }
                else {
                    $this->log($admin->errors(),'debug');
                        $this->Flash->error($admin->errors(), [
                            'params' => [
                                'saves' => $admin->errors()
                            ]
                        ]);
                }
            }
            else {
                    $this->Flash->error('Incorrect Password', [
                    'params' => [
                        'saves' => 'Incorrect Password!'
                        ]
                    ]);
            }

            
        }
    }

    public function userSettingsInfo()
    {   
        $this->header();
        $this->userSettingsSidebar('info');
        $this->title('PUPQC Web Portal | Edit Info');

        $user_id = $this->Auth->user('id');  

        $this->loadModel('Users');

        $user_info = $this->Users->find('all')->where(['Users.id' => $user_id])->first();
        $this->set('user_info',$user_info);

        $getProfile = $this->User_Profiles->find('all')->where(['User_Profiles.user_profile_user_id' => $user_id])->first();
        $this->set('profile',$getProfile);

        if ($this->request->is(['post', 'put'])) {
            if (!empty($this->request->data)) {
                
                $usersTable = TableRegistry::get('Users');
                $usersTable = TableRegistry::getTableLocator()->get('Users');
                $user = $usersTable->get($user_id);


                $user->email = $this->request->data['email'];
            
            }

            $confirmPassword = $this->request->data['confirm_password'];

            if ((new DefaultPasswordHasher)->check($confirmPassword, $user_info->password)) {

            if ($usersTable->save($user)) {
                        $this->Flash->success('User Info Updated!', [
                            'params' => [
                                'saves' => 'User Info Updated!'
                            ]
                        ]);
                        return $this->redirect(['action' => 'userSettingsInfo']);
                }
                else {
                    $this->log($admin->errors(),'debug');
                        $this->Flash->error($admin->errors(), [
                            'params' => [
                                'saves' => $admin->errors()
                            ]
                        ]);
                }
            }
            else {
                    $this->Flash->error('Incorrect Password', [
                    'params' => [
                        'saves' => 'Incorrect Password!'
                        ]
                    ]);
            }

        }
    }

    public function userSettingsPassword()
    {   
        $this->header();
        $this->userSettingsSidebar('password');
        $this->title('PUPQC Web Portal | Edit Password');
        $this->adminProfileSideBar('password');

        $user_password = $this->Users->find('all')->where(['Users.id'=>$this->Auth->user('id')])->first();
        $this->set('user_password',$user_password);

        if ($this->request->is(['post', 'put'])) {

            $usersTable = TableRegistry::get('Users');

            $usersTable = TableRegistry::getTableLocator()->get('Users');
            $users = $usersTable->get($this->Auth->user('id'));

            $current_password = $this->request->data['current_password'];

            if ((new DefaultPasswordHasher)->check($current_password, $user_password->password)) {

                $hasher = new DefaultPasswordHasher();
                $users->password = $hasher->hash($this->request->data['new_password']);

                 if ($usersTable->save($users)) {
                    $this->Flash->success('User Updated!', [
                    'params' => [
                        'saves' => 'Password Updated!'
                        ]
                    ]);
                    return $this->redirect(['action' => 'userSettingsPassword']);
                }
                else {
                    $this->Flash->error('Error', [
                    'params' => [
                        'saves' => 'error!'
                        ]
                    ]);
                }
            }
            else {
                    $this->Flash->error('Incorrect Password', [
                    'params' => [
                        'saves' => 'incorrect Password!'
                        ]
                    ]);
            }
      }      
    }

    public function login()
    {   
        $this->log(Router::url( $this->referer(), true ),'debug');
        $this->log(Router::url( $this->referer()),'debug');
        $this->set(compact('employees'));
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);

                # check if user is admin. If admin redirect to admin panel, else to user's index page
                $user_type = $this->Users->find('all')->where(['Users.id' => $this->Auth->user('id')])->first()->user_type_id;
                if ($user_type == 1) {
                    return $this->redirect(array("prefix" => "admin","controller" => "Dashboard",
                       "action" => "index"));
                }
                else {
                    return $this->redirect(array("controller" => "Users",
                       "action" => "index"));
                }
            }
            else {
                $this->Flash->logout('Your username or password is incorrect.');
            }
        }
    }

    public function logout()
    {
        $this->Flash->logout('You are now logged out.');
        return $this->redirect($this->Auth->logout());
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

    if (in_array($this->request->action, ['index', 'userProfile','userSettingsProfile','userSettingsInfo','userSettingsPassword','register','adminAll','adminAdd','adminEdit','adminDelete','employeesAll','employeeAdd','employeeEdit','studentsAll','studentAdd','studentEdit','alumniAll','alumniAdd','alumniEdit','deleteUser','logout'])) {
        return true;
    }

        return parent::isAuthorized($user);
    }
}
