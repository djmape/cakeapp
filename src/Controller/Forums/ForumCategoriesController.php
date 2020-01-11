<?php
namespace App\Controller\Forums;

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
class ForumCategoriesController extends AppController
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

    public function forumCategoriesIndex()
    {   
        $this->header();
        $forum_categories_count;
        $this->title('PUPQC Forum | Categories');

        $this->loadModel('ForumCategories');
        $this->loadModel('ForumTopics');
        $forumCategories = $this->paginate($this->ForumCategories->find('all')->contain(['ForumTopics.ForumTopicDetails','ForumTopics.Users','ForumCategoryDetails']));

        if ($forumCategories->count() == 0) {
            $forum_categories_count = 0;
        }
        else {
            $forum_categories_count = $forumCategories->count();
        }

        
        $this->set('forumCategories', $forumCategories);
        $this->set(compact('forumCategories'));
        $this->set('forum_categories_count', $forum_categories_count);
    }


    public function forumCategoriesAll()
    {   
        $this->header();
        $this->title('PUPQC | All Categories');


        $this->loadModel('ForumCategories');
        $this->loadModel('ForumCategoryDetails');
        $forumCategories = $this->paginate($this->ForumCategories->find('all')->contain('ForumCategoryDetails')->where(['ForumCategories.forum_category_active' => 1]));
        $this->set(compact('forumCategories'));
    }

    public function forumTopicsIndex($forum_category_name)
    {   
        $this->header();
        $this->title('PUPQC Forum | Topics');
        $this->loadModel('ForumCategories');
        $forumCategory = $this->ForumCategories->find('all')->where(['ForumCategories.forum_category_name' => str_replace('-', ' ', $forum_category_name)])->first();

        $forum_category_id = $forumCategory->forum_category_id;

        $this->loadModel('ForumCategories');
        $this->loadModel('ForumTopics');
        $forumTopics = $this->paginate($this->ForumTopics->find('all')->contain(['ForumTopicDetails','ForumCategories','Users'])->where(['ForumCategories.forum_category_id' => $forum_category_id]));

        $this->set('forumTopics', $forumTopics);
        $this->set(compact('forumTopics'));
        $this->set('forumCategory', $forumCategory);
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

    if (in_array($this->request->action, ['forumCategoriesIndex','forumCategoriesAll','forumTopicsIndex','forumReplies','register','adminAll','adminAdd','adminEdit','adminDelete','employeesAll','employeeAdd','employeeEdit','studentsAll','studentAdd','studentEdit','alumniAll','alumniAdd','alumniEdit','deleteUser','logout'])) {
        return true;
    }

        return parent::isAuthorized($user);
    }
}
