<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Mailer\Email;
use App\Form\EmailForm;
use Cake\Routing\Router;
use Cake\I18n\Time;
use Cake\ORM\Query;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function beforeFilter(Event $event)
    {
       // allow all action
        $this->Auth->deny();
        $this->Auth->allow(['userProfile']);
    }

    public function initialize()
    {
        $this->loadComponent('Paginator');
        parent::initialize();
        $this->navBar('users');
        $this->userHeader();
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {   
        $current_user = $this->Auth->user('id');

        $this->loadModel('Posts');
        $this->loadModel('Announcements');
        $this->loadModel('OrganizationAnnouncements');
        $this->loadModel('Events');
        $this->loadModel('Users');
        $this->loadModel('UserProfiles');

        $posts = $this->Posts->find('all')->contain(['Users.UserProfiles','Announcements','Events',
            'OrganizationAnnouncements.Organizations.OrganizationMembers',
            'OrganizationEvents.Organizations'])->
            where(['Posts.post_active' => 1]);
        $this->set(compact('posts'));
        $this->set('current_user', $current_user);
    }

    public function userProfile($username)
    {   

        $this->loadModel('Users');
        $currentUser = $this->Auth->user('id');
        $user = $this->Users->find('all')->contain(['UserTypes'])->where(['Users.username' => $username])->first();
        $user_id = $user->id;
        $this->set('userProfile',$user);

        $this->title('User | ' . $user->user_lastname . ', ' . $user->user_firstname . ' ' .substr($user->user_middlename,0 ,1) . '.');

        $user_type = $user->user_type->user_type_name;
        $this->set('user_type',$user_type);

        $this->header();
        $this->loadModel('UserActivities');

        $getProfile = $this->User_Profiles->find('all')->where(['User_Profiles.user_profile_user_id' => $user_id])->first();
        $this->set('profile',$getProfile);

        $userActivities = $this->UserActivities->find('all')->contain([
            'UserPostReactions',
            'UserPostActivities.Posts.Announcements',
            'UserPostActivities.Posts.Events',
            'UserPostActivities.Posts.OrganizationAnnouncements.Organizations.OrganizationMembers',
            'UserPostActivities.Posts.OrganizationEvents.Organizations',
            'PostComments.PostCommentContents' ,'ForumCategoryActivities.ForumCategories','ForumActivities.ForumTopicActivities.ForumTopics','ForumActivities.ForumDiscussionActivities.ForumDiscussions.ForumDiscussionDetails','ForumActivities.ForumReplyActivities.ForumReplies.ForumReplyDetails','ForumActivities.ForumDiscussionActivities.ForumDiscussions.ForumDiscussionDetails','ForumActivities.ForumDiscussionActivities.ForumDiscussions.ForumTopics.ForumCategories','ForumActivities.ForumTopicActivities.ForumTopics.ForumCategories','ForumActivities.ForumCategoryActivities.ForumCategories','ForumActivities.ForumReplyActivities.ForumReplies.ForumReplyDetails','ForumActivities.ForumReplyActivities.ForumReplies.ForumDiscussions.ForumDiscussionDetails','ForumActivities.ForumReplyActivities.ForumReplies.ForumDiscussions.ForumTopics','ForumActivities.ForumReplyActivities.ForumReplies.ForumDiscussions.ForumTopics.ForumCategories','Users'])->where(['UserActivities.user_activity_user_id' => $user_id])->order(['UserActivities.user_activity_timestamp' => 'DESC']);
        $this->set(compact('userActivities')); 



        $this->loadModel('UserForumActivityCounts');
        $user_forum_activity_statistics = $this->UserForumActivityCounts->find('all')->where(['UserForumActivityCounts.user_id' => $user_id])->first();
        $this->set('user_forum_activity_statistics',$user_forum_activity_statistics);

        if ($currentUser == $user_id) {
            $this->set('pronoun', 'You');
        }
        else {
            $this->set('pronoun', $username);
        }

        
    }

    public function userSettingsProfile()
    {   
        $user_id = $this->Auth->user('id');

        $this->header();
        $this->userSettingsSidebar('profile');
        $this->userSettings(true);
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
        $this->userSettings(true);
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
        $url = 'http://localhost/cakeapp' ;
        $redirectUrl = $this->request->getQuery('redirect');
        $this->log($redirectUrl,'debug');
        if ($this->Auth->user()) {
            return $this->redirect(array("prefix" => "front","controller" => "home",
                       "action" => "index"));
        }
        else {

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
                        if ($redirectUrl == '') {
                            return $this->redirect(["prefix" => "admin","controller" => "Abouts","action" => "index"]);
                        }
                        else {
                            $url = 'http://localhost/cakeapp' ;
                            $redirectUrl = $this->request->getQuery('redirect');
                            return $this->redirect($url. $redirectUrl);
                        }
                    }
                    else {
                        if ($redirectUrl == '') {
                            return $this->redirect(["controller" => "Users","action" => "index"]);
                        }
                        else {
                            $url = 'http://localhost/cakeapp' ;
                            $redirectUrl = $this->request->getQuery('redirect');
                            return $this->redirect($url. $redirectUrl);
                        }
                    }
                }
                else {
                    $this->Flash->logout('Your username or password is incorrect.');
                }
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

    public function organizationPanel($organization_name) {

        $organization_name = str_replace('-', ' ', $organization_name);
        $this->organizationPanelSidebar('organizationPanel');
        $this->title('PUPQC | ' . $organization_name);

        $this->set('organization_name', $organization_name);

        $this->loadModel('Organizations');
        $organization = $this->Organizations->find('all')->where(['Organizations.organization_name' => $organization_name])->first();
        $this->set('organization', $organization);
    }

    public function organizationInformationEdit($organization_name)
    {
        $this->title('Admin | Edit Organization');
        $this->organizationPanelSidebar('organizationInformation');

        $organization_name = str_replace('-', ' ', $organization_name);

        $this->loadModel('Organizations');
        $organization = $this->Organizations->find('all')->where(['Organizations.organization_name' => $organization_name])->first();
        $this->set('organization', $organization);

        $organization_id = $organization->organization_id;

        $row = $organization;
        
        if ($this->request->is(['post', 'put'])) {
            if (!empty($this->request->data)) {
                if (!empty($this->request->data['organization_photo']['name'])) {
                    $file = $this->request->data['organization_photo']; //put the data into a var for easy use
                    
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
                        $imageFileName = $row->organization_photo;
                    }

                $organizationsTable = TableRegistry::get('Organizations');

                $organizationsTable = TableRegistry::getTableLocator()->get('Organizations');
                $organization = $organizationsTable->get($organization_id);

                $organization->organization_type = $this->request->data['organization_type'];
                $organization->organization_name = $this->request->data['organization_name'];
                $organization->organization_acronym = $this->request->data['organization_acronym'];
                $organization->organization_mission = $this->request->data['organization_mission'];
                $organization->organization_vision = $this->request->data['organization_vision'];
                $organization->organization_goal = $this->request->data['organization_goal'];
                $organization->organization_objective = $this->request->data['organization_objective'];
                $organization->organization_photo = $imageFileName;

                    if (!empty($this->request->data['organization_photo']['name'])) {
                        $organization->organization_photo = $imageFileName;
                    }

            }

            if ($organizationsTable->save($organization)) {
                $this->Flash->success('Organization Updated!', [
                    'params' => [
                        'saves' => 'Organization Updated!'
                        ]
                    ]);
            }
            else {
                $this->Flash->error(__('Unable to update organization.'));
            }
        }

        $this->set('row', $row);
    }

    public function organizationAnnouncementsAll($organization_name) {

        $organization_name = str_replace('-', ' ', $organization_name);

        $this->header();
        $this->organizationPanelSidebar('organizationAnnouncements');
        $this->title('PUPQC | Organization Panel');

        $this->loadModel('OrganizationAnnouncements');
        $this->loadModel('Organizations');

        $organization = $this->Organizations->find('all')->where(['Organizations.organization_name' => $organization_name])->first();
        $this->set('organization', $organization);

        $organization_announcements = $this->paginate($this->OrganizationAnnouncements->find('all')->contain(['Organizations'])->where(['OrganizationAnnouncements.active' => 1, 'OrganizationAnnouncements.organization_id' => $organization->organization_id]));
        $this->set('organization_announcements', $organization_announcements);
    }

    public function organizationAnnouncementAdd($organization_name) {

        $organization_name = str_replace('-', ' ', $organization_name);

        $this->header();
        $this->organizationPanelSidebar('organizationAnnouncements');
        $this->title('PUPQC | Organization Panel');

        $this->loadModel('Posts');
        $this->loadModel('UserActivities');
        $this->loadModel('UserPostActivities');
        $this->loadModel('PostReactions');
        $this->loadModel('OrganizationAnnouncements');

        $organization = $this->Organizations->find('all')->where(['Organizations.organization_name' => $organization_name])->first();
        $this->set('organization', $organization);

        $currentUser = $this->Auth->user('id');

        $organizationAnnouncement = $this->OrganizationAnnouncements->newEntity();
        $this->set('announcement', $organizationAnnouncement);

        $post = $this->Posts->newEntity();
        $userActivity = $this->UserActivities->newEntity();
        $userPostActivity = $this->UserPostActivities->newEntity();
        $postReactions = $this->PostReactions->newEntity();

        if ($this->request->is('post')) {

            # begin save Posts

            $post->post_user_id = $currentUser;
            $post->post_post_type_id = 4; # organization announcement
            $post->post_active = 1;

            if ($postID = $this->Posts->save($post)) {

                # begin save UserActivities

                $userActivity->user_activity_activity_type_id = 1; # posts
                $userActivity->user_activity_user_id = $currentUser;
                $userActivity->user_activity_post_id = $postID->post_id;

                if ($userActivity = $this->UserActivities->save($userActivity)) {

                    # begin save UserPostActivities

                    $userPostActivity->user_post_activity_user_id = $currentUser;
                    $userPostActivity->user_post_activity_type_id = 1; # Create
                    $userPostActivity->user_post_activity_post_id = $postID->post_id;
                    $userPostActivity->user_post_activities_user_activity_id = $userActivity->user_activity_id;

                    if ($this->UserPostActivities->save($userPostActivity)) {

                        # begin save PostReactions

                        $postReactions->post_reactions_post_id = $postID->post_id;
                        $postReactions->post_comments_count = 0;
                        $postReactions->post_likes_count = 0;
                        $postReactions->post_dislikes_count = 0;

                        if ($this->PostReactions->save($postReactions)) {

                            # begin save OrganizationAnnouncements

                            $organizationAnnouncement->organization_announcement_title = $this->request->data('organization_announcement_title');
                            $organizationAnnouncement->organization_announcement_body = $this->request->data('organization_announcement_body');
                            $organizationAnnouncement->announcement_post_id = $postID->post_id;
                            $organizationAnnouncement->organization_announcement_visibility_members_only = $this->request->data('organization_announcement_visibility_members_only');
                            $organizationAnnouncement->organization_id = $organization->organization_id;

                            if ($this->OrganizationAnnouncements->save($organizationAnnouncement)) {

                                return $this->redirect(['action' => 'organizationAnnouncementsAll',  str_replace(' ', '-', $organization_name)]);
                            }
                            else {
                                $this->log($organizationAnnouncement->errors(),'debug');
                            }
                            # end save OrganizationAnnouncements
                        }
                        else {
                            $this->log($postReactions->errors(),'debug');
                        }
                        # end save PostReactions
                    }
                    else {
                        $this->log($userPostActivity->errors(),'debug');
                    }
                    # end save UserPostActivities
                }
            }
            else {
                $this->log($userActivity->errors(),'debug');
            }
            # end save UserActivities
            
        }
    }

    public function organizationAnnouncementEdit($organization_name,$organization_announcement_id) {

        $organization_name = str_replace('-', ' ', $organization_name);

        $this->loadModel('Organizations');
        $organization = $this->Organizations->find('all')->where(['Organizations.organization_name' => $organization_name])->first();
        $this->set('organization', $organization);

        $this->header();
        $this->organizationPanelSidebar('organizationAnnouncements');
        $this->title('PUPQC | Edit Announcement');

        $this->loadModel('OrganizationAnnouncements');

        $organizationAnnouncement = $this->OrganizationAnnouncements->find('all')->where(['OrganizationAnnouncements.organization_announcement_id' => $organization_announcement_id])->first();
        $this->set('organizationAnnouncement', $organizationAnnouncement);
        
        if ($this->request->is(['post', 'put'])) {

            $organizationAnnouncementsTable = TableRegistry::get('OrganizationAnnouncements');
            $organizationAnnouncementsTable = TableRegistry::getTableLocator()->get('OrganizationAnnouncements');
            $organization_announcement = $organizationAnnouncementsTable->get($organization_announcement_id);

            $organization_announcement->organization_announcement_title = $this->request->data['organization_announcement_title'];
            $organization_announcement->organization_announcement_body = $this->request->data['organization_announcement_body'];
            $organization_announcement->organization_announcement_modified = Time::now();
            $organization_announcement->organization_announcement_visibility_members_only = $this->request->data('organization_announcement_visibility_members_only');

            if ($organizationAnnouncementsTable->save($organization_announcement)) {
                return $this->redirect(['action' => 'organizationAnnouncementsAll',  str_replace(' ', '-', $organization_name)]);
            }
            else {
                debug($organization_announcement->errors(),'debug');
            }
            
        }

    }

    public function organizationAnnouncementDelete() {

        $this->layout = false;
        $this->autoRender = false;

        $this->loadModel('OrganizationAnnouncements');

        $organization_name = $this->request->data['organization_name'];

        if ($this->request->is(['post', 'put'])) {

            $organization_announcement_id = $this->request->data('organization_announcement_id');

            $organizationAnnouncementTable = TableRegistry::get('OrganizationAnnouncements');

            $organizationAnnouncementTable = TableRegistry::getTableLocator()->get('OrganizationAnnouncements');
            $organization_announcement = $organizationAnnouncementTable->get($organization_announcement_id);

            $organization_announcement->active = 0;

            if ($organizationAnnouncementTable->save($organization_announcement)) {
                return $this->redirect(['action' => 'organizationAnnouncementsAll',  str_replace(' ', '-', $organization_name)]);
            }
            else {
                debug($organization_announcement->errors(),'debug');
            }
        }
    }


    public function organizationEventsAll($organization_name) {
        
        $organization_name = str_replace('-', ' ', $organization_name);

        $this->header();
        $this->organizationPanelSidebar('organizationEvents');
        $this->title('PUPQC | Organization Panel');

        $this->loadModel('Organizations');
        $organization = $this->Organizations->find('all')->where(['Organizations.organization_name' => $organization_name])->first();
        $this->set('organization', $organization);

        $this->loadModel('OrganizationEvents');
        $organizationEvents = $this->paginate($this->OrganizationEvents->find('all', array(
        'order'=>array('FIELD(OrganizationEvents.organization_event_status,"Ongoing","Upcoming","Past") ASC')))->contain(['Posts'])->where(['OrganizationEvents.active' => 1,'OrganizationEvents.event_post_id  IS NOT' => null]));
        $this->set('organizationEvents', $organizationEvents);
        $this->log($organizationEvents->first(),'debug');

        $this->set('currentUser', $this->Auth->user('id'));
    }

    public function organizationEventAdd($organization_name) {
        
        $organization_name = str_replace('-', ' ', $organization_name);

        $this->header();
        $this->organizationPanelSidebar('organizationEvents');
        $this->title('PUPQC | Organization Panel');

        $this->loadModel('Organizations');
        $organization = $this->Organizations->find('all')->where(['Organizations.organization_name' => $organization_name])->first();
        $this->set('organization', $organization);

        $this->loadModel('OrganizationEvents');
        $this->loadModel('Posts');
        $this->loadModel('UserActivities');
        $this->loadModel('UserPostActivities');
        $this->loadModel('PostReactions');

        $organizationEvent = $this->OrganizationEvents->newEntity();
        $post = $this->Posts->newEntity();
        $userActivity = $this->UserActivities->newEntity();
        $userPostActivity = $this->UserPostActivities->newEntity();
        $postReactions = $this->PostReactions->newEntity();

        $this->set('organizationEvent', $organizationEvent);

        $currentUser = $this->Auth->user('id');

        if ($this->request->is('post')) {
            
            $post->post_user_id = $currentUser;
            $post->post_post_type_id = 5; # organization events
            $post->post_active = 1;


            if ($postID = $this->Posts->save($post)) {

                # begin save UserActivities

                $userActivity->user_activity_activity_type_id = 1; # post
                $userActivity->user_activity_user_id = $currentUser;
                $userActivity->user_activity_post_id = $postID->post_id;

                if ($this->UserActivities->save($userActivity)) {

                    # begin save UserPostActivities

                    $userPostActivity->user_post_activity_user_id = $currentUser;
                    $userPostActivity->user_post_activity_type_id = 1; # create
                    $userPostActivity->user_post_activity_post_id = $postID->post_id;
                    $userPostActivity->user_post_activities_user_activity_id = $userActivity->user_activity_id;

                    if ($this->UserPostActivities->save($userPostActivity)) {

                        # begin save PostReactions

                        $postReactions->post_comments_count = 0;
                        $postReactions->post_likes_count = 0;
                        $postReactions->post_dislikes_count = 0;
                        $postReactions->post_reactions_post_id = $postID->post_id;

                        if ($this->PostReactions->save($postReactions)) {

                            # begin save Events

                            if (!empty($this->request->data)) {

                                if (!empty($this->request->data['organization_event_photo']['name'])) {

                                    $file = $this->request->data['organization_event_photo']; //put the data into a var for easy use

                                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                                    $setNewFileName = time() . "_" . rand(000000, 999999);
                                    
                                    // only process if the extension is valid
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
                            }

                            $event_start_date = date('Y-m-d', strtotime($this->request->data['organization_event_start_date']));
                            $event_start_time = date('H:i:s', strtotime($this->request->data['organization_event_start_time']));
                            $event_end_date = date('Y-m-d', strtotime($this->request->data['organization_event_end_date']));
                            $event_end_time = date('H:i:s', strtotime($this->request->data['organization_event_end_time']));

                            $organizationEvent->organization_event_title = $this->request->data['organization_event_title'];
                            $organizationEvent->organization_event_body = $this->request->data['organization_event_body'];
                            $organizationEvent->organization_event_created = Time::now();;
                            $organizationEvent->organization_event_modified = Time::now();;
                            $organizationEvent->organization_event_start_date = $event_start_date;
                            $organizationEvent->organization_event_start_time = $event_start_time;
                            $organizationEvent->organization_event_end_date = $event_end_date;
                            $organizationEvent->organization_event_end_time = $event_end_time;
                            $organizationEvent->organization_event_sponsors = $this->request->data['organization_event_sponsors'];
                            $organizationEvent->organization_event_participants = $this->request->data['organization_event_participants'];
                            $organizationEvent->organization_event_location = $this->request->data['organization_event_location'];
                            //$event->event_location_embed = $this->request->data['event_location_embed'];
                            $organizationEvent->organization_event_status = '';
                            $organizationEvent->organization_event_visibility = 1;
                            $organizationEvent->organization_event_photo = $imageFileName;
                            $organizationEvent->active = 1;
                            $organizationEvent->organization_announcement_visibility_members_only = $this->request->data['organization_announcement_visibility_members_only'];
                            $organizationEvent->organization_id = $organization->organization_id;
                            $organizationEvent->event_post_id = $postID->post_id;

                            if ($this->OrganizationEvents->save($organizationEvent)) {
                                return $this->redirect(['action' => 'organizationEventsAll',  str_replace(' ', '-', $organization_name)]);
                            }
                            else {
                                $this->log($event->errors(),'debug');
                            }
                            # end save Events
                        }
                        else {
                            $this->log($postReactions->errors(),'debug');
                        }
                        # end save PostReactions
                    }
                    else {
                        $this->log($userPostActivity->errors(),'debug');
                    }
                    # end save UserPostActivities
                }
                else {
                    $this->log($userPostActivity->errors(),'debug');
                }
                # end save UserActivities
            }
            else {
                $this->log($post->errors(),'debug');
            }
            # end save Posts            
        }

    }

    public function organizationEventEdit($organization_name,$organization_event_id) {

        $organization_name = str_replace('-', ' ', $organization_name);

        $this->header();
        $this->organizationPanelSidebar('organizationEvents');
        $this->title('PUPQC | Organization Panel');

        $this->loadModel('Organizations');
        $organization = $this->Organizations->find('all')->where(['Organizations.organization_name' => $organization_name])->first();
        $this->set('organization', $organization);

        $this->loadModel('OrganizationEvents');
        $organizationEvent = $this->OrganizationEvents->find('all')->where(['OrganizationEvents.organization_event_id' => $organization_event_id])->first();

        $organizationEvent->organization_event_start_time = $organizationEvent->organization_event_start_time->format('h:i A');
        $organizationEvent->organization_event_end_time = $organizationEvent->organization_event_end_time->format('h:i A');

        $this->set('organizationEvent', $organizationEvent);
        
        if ($this->request->is(['post', 'put'])) {

            if (!empty($this->request->data)) {
                if (!empty($this->request->data['organization_event_photo']['name'])) {
                    $file = $this->request->data['organization_event_photo']; //put the data into a var for easy use

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
                        $imageFileName =  $organizationEvent->organization_event_photo;
                    }

            }

            $organizationEventsTable = TableRegistry::get('OrganizationEvents');

            $organizationEventsTable = TableRegistry::getTableLocator()->get('OrganizationEvents');
            $organization_event = $organizationEventsTable->get($organization_event_id);



                $organization_event_start_date = date('Y-m-d', strtotime($this->request->data['organization_event_start_date']));
                $organization_event_start_time = date('H:i:s', strtotime($this->request->data['organization_event_start_time']));
                $organization_event_end_date = date('Y-m-d', strtotime($this->request->data['organization_event_end_date']));
                $organization_event_end_time = date('H:i:s', strtotime($this->request->data['organization_event_end_time']));

                $organization_event->organization_event_title = $this->request->data['organization_event_title'];
                $organization_event->organization_event_body = $this->request->data['organization_event_body'];
                $organization_event->organization_event_modified = Time::now();;
                $organization_event->organization_event_start_date = $organization_event_start_date;
                $organization_event->organization_event_start_time = $organization_event_start_time;
                $organization_event->organization_event_end_date = $organization_event_end_date;
                $organization_event->organization_event_end_time = $organization_event_end_time;
                $organization_event->organization_event_sponsors = $this->request->data['organization_event_sponsors'];
                $organization_event->organization_event_participants = $this->request->data['organization_event_participants'];
                $organization_event->organization_event_location = $this->request->data['organization_event_location'];
                //$event->event_location_embed = $this->request->data['event_location_embed'];
                $organization_event->organization_event_photo = $imageFileName;
                $organization_event->organization_announcement_visibility_members_only = $this->request->data['organization_announcement_visibility_members_only'];


            if ($organizationEventsTable->save($organization_event)) {
                return $this->redirect(['action' => 'organizationEventsAll',  str_replace(' ', '-', $organization_name)]);
            }
            else {
                $this->log($organization_event->errors(),'debug');
            }
        }

    }

    public function organizationEventDelete() {

        $this->layout = false;
        $this->autoRender = false;

        $this->loadModel('OrganizationEvents');

        $organization_name = $this->request->data['organization_name'];

        if ($this->request->is(['post', 'put'])) {

            $organization_event_id = $this->request->data('organization_event_id');

            $organizationEventsTable = TableRegistry::get('OrganizationEvents');

            $organizationEventsTable = TableRegistry::getTableLocator()->get('OrganizationEvents');
            $organization_event = $organizationEventsTable->get($organization_event_id);

            $organization_event->active = 0;

            if ($organizationEventsTable->save($organization_event)) {
                return $this->redirect(['action' => 'organizationEventsAll',  str_replace(' ', '-', $organization_name)]);
            }
            else {
                debug($organization_event->errors(),'debug');
            }
        }
    }

    public function organizationMembersAll($organization_name) {

        $organization_name = str_replace('-', ' ', $organization_name);

        $this->header();
        $this->organizationPanelSidebar('organizationMembers');
        $this->title('PUPQC | Organization Panel');

        $this->loadModel('Organizations');
        $organization = $this->Organizations->find('all')->where(['Organizations.organization_name' => $organization_name])->first();
        $this->set('organization', $organization);
        $this->log($organization->organization_name,'debug');

        $organization_id = $organization->organization_id;

        $this->loadModel('OrganizationMembers');
        $organization_members = $this->paginate($this->OrganizationMembers->find('all')->contain(['Organizations','Users'])->where(['OrganizationMembers.organization_id' => $organization_id,'OrganizationMembers.active' => 1]));
        $this->set('organization_members', $organization_members);

        # load Users
        $this->loadModel('Users');
        $this->loadModel("User_Types");
        $users = $this->Users->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row['user_lastname'] . ', ' . $row['user_firstname'] . ' ' . $row['user_middlename'];
            }
        ])->notMatching("OrganizationMembers", 
                         function($q) use($organization_id) {
                            return $q->where(["OrganizationMembers.active"=>1])->where(["OrganizationMembers.organization_id"=>$organization_id]);
                         })
        ->where(['Users.active' => 1,'Users.user_lastname IS NOT' => null])->order([
        'Users.user_lastname' => 'ASC'
        ]);
        $this->log($users->count(),'debug');

        $users_count = 1;
        if ($users->count() == 0) {
            $users_count = 0;
        }
        else {
            $this->set('assignUsers', $users);
        }
        $this->set('users_count', $users_count);

        $organization_member = $this->OrganizationMembers->newEntity();
        $this->set('organization_member', $organization_member);
    }

    public function organizationMemberAdd() {

        $this->layout = false;
        $this->autoRender = false;

        $this->loadModel('OrganizationMembers');
        $organization_member = $this->OrganizationMembers->newEntity();

        if ($this->request->is(['post','put'])) {

            $user_id = $this->request->data['user_id'];
            $organization_id = $this->request->data['organization_id'];

            $findUserInOrganizationMembers = $this->OrganizationMembers->find('all')->where(['OrganizationMembers.user_id' => $user_id, 'OrganizationMembers.organization_id' => $organization_id]);

            # if user exists in organization but active = 0
            if ($findUserInOrganizationMembers->count() != 0) {

                $organization_member_id = $findUserInOrganizationMembers->first()->organization_member_id;

                $organizationMembersTable = TableRegistry::get('OrganizationMembers');

                $organizationMembersTable = TableRegistry::getTableLocator()->get('OrganizationMembers');
                $organization_member = $organizationMembersTable->get($organization_member_id);

                $organization_member->active = 1;

                if ($organizationMembersTable->save($organization_member)) {

                }
                else {
                    debug($organization_member->errors(),'debug');
                }
            }
            # if user doesn't exists in organization 
            else {
                $organization_member->user_id = $user_id;
                $organization_member->organization_id = $organization_id;
                if ($this->OrganizationMembers->save($organization_member)) {
                
                }
                else {
                    $this->log($organization_member->errors(),'debug');
                }
            }
        }
    }

    public function organizationMemberDelete() {

        $this->layout = false;
        $this->autoRender = false;

        $this->loadModel('OrganizationMembers');

        if ($this->request->is(['post', 'put'])) {

            $organization_member_id = $this->request->data('organization_member_id');

            $organizationMembersTable = TableRegistry::get('OrganizationMembers');

            $organizationMembersTable = TableRegistry::getTableLocator()->get('OrganizationMembers');
            $organization_member = $organizationMembersTable->get($organization_member_id);

            $organization_member->active = 0;

            if ($organizationMembersTable->save($organization_member)) {

            }
            else {
                $this->log($organization_member->errors(),'debug');
            }
        }
    }

    public function userNotifications($username) {

        $this->header();
        $this->title('PUPQC | Notifications');

    }

    public function userNotificationRead() {

        $this->layout = false;
        $this->autoRender = false;

        if ($this->request->is(['post', 'put'])) {
            
            $user_notification_id = $this->request->getData('user_notification_id');


            $userNotificationsTable = TableRegistry::get('UserNotifications');

            $userNotificationsTable = TableRegistry::getTableLocator()->get('UserNotifications');
            $userNotification = $userNotificationsTable->get($user_notification_id);

            $userNotification->user_notification_read_status = true;
            $userNotification->user_notification_date_read = Time::now();

            if ($userNotificationsTable->save($userNotification)) {

            }
            else {
                $this->log($userNotification->errors(),'debug');
            }
            
        }
    }

    public function isAuthorized($user) {

    if (in_array($this->request->action, ['index', 'userProfile','userSettingsProfile','userSettingsInfo','userSettingsPassword','organizationPanel','organizationAnnouncementsAll','organizationAnnouncementAdd','organizationAnnouncementEdit','organizationAnnouncementDelete','organizationEventsAll','organizationEventAdd','organizationEventEdit','organizationEventDelete','organizationMembersAll','organizationMemberAdd','organizationMemberEdit','organizationInformationEdit','organizationMemberDelete','userNotifications','userNotificationRead','alumniEdit','deleteUser','logout'])) {
        return true;
    }

        return parent::isAuthorized($user);
    }
}
