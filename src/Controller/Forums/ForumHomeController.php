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
class ForumHomeController extends AppController
{
	public function beforeFilter(Event $event)
    {
       // allow all action
        $this->Auth->allow(['index','forumCategoriesAll','forumTopicsIndex']);
    }

    public function initialize()
    {
        parent::initialize();
        $this->checkLoginStatus();
    }
    
    public function index()
    {   
        $this->header();
        $this->title('PUPQC | Forum Home');

        $this->loadModel('Posts');
        $this->loadModel('Announcements');
        $this->loadModel('Users');
        $this->loadModel('UserProfiles');

        $this->loadModel('ForumCategories');
        $this->loadModel('ForumCategoryDetails');
        $forumCategories = $this->paginate($this->ForumCategories->find('all')->contain('ForumCategoryDetails')->where(['ForumCategories.forum_category_active' => 1]));
        $this->set(compact('forumCategories'));
        $this->loadModel('ForumTopics');
        $this->loadModel('ForumTopicDetails');
        $forumTopics = $this->ForumTopics->find('all')->contain(['ForumTopicDetails','ForumCategories','Users'])->where(['ForumTopics.forum_topic_active' => 1]);
        $this->set(compact('forumTopics'));

        $this->loadModel('ForumDiscussions');
        $forumDiscussions = $this->ForumDiscussions->find('all')->contain(['ForumDiscussionDetails','ForumTopics.ForumCategories','ForumTopics.ForumTopicDetails','Users'])->where(['ForumDiscussions.forum_discussion_active' => 1])->limit(10)->order(['ForumDiscussions.forum_discussion_created' => 'DESC'])->where(['ForumDiscussions.forum_discussion_active' => 1]);
        $this->set('forumDiscussions', $forumDiscussions);
    }


    public function isAuthorized($user) {

    if (in_array($this->request->action, ['index'])) {
        return true;
    }

        return parent::isAuthorized($user);
    }
}
