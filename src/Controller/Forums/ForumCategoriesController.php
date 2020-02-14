<?php
namespace App\Controller\Forums;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Mailer\Email;
use App\Form\EmailForm;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ForumCategoriesController extends AppController
{
	public function beforeFilter(Event $event)
    {
       // allow all action
        $this->Auth->allow(['forumCategoriesIndex','forumCategoriesAll','forumTopicsIndex']);
    }

    public function initialize()
    {
        parent::initialize();
        $this->checkLoginStatus();
    }
    
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

        $currentUser = $this->Auth->user('id');
        $forum_category_id = $forumCategory->forum_category_id;

        $this->loadModel('ForumCategories');
        $this->loadModel('ForumTopics');
        $this->loadModel('ForumDiscussions');

        $forumTopics = $this->paginate($this->ForumTopics->find('all')->contain(['ForumTopicDetails','ForumCategories','Users','ForumDiscussions.Users'])->where(['ForumCategories.forum_category_id' => $forum_category_id,'ForumTopics.forum_topic_active' => 1]));

        $this->set('currentUser', $currentUser);
        $this->set('forumTopics', $forumTopics);
        $this->set(compact('forumTopics'));
        $this->set('forumCategory', $forumCategory);
    }


    public function isAuthorized($user) {

    if (in_array($this->request->action, ['forumCategoriesIndex','forumCategoriesAll','forumTopicsIndex','forumReplies','register','adminAll','adminAdd','adminEdit','adminDelete','employeesAll','employeeAdd','employeeEdit','studentsAll','studentAdd','studentEdit','alumniAll','alumniAdd','alumniEdit','deleteUser','logout'])) {
        return true;
    }

        return parent::isAuthorized($user);
    }
}
