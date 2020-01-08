<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Tags Controller
 *
 * @property \App\Model\Table\TagsTable $Tags
 *
 * @method \App\Model\Entity\Tag[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TestsController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
        $this->Auth->allow(['index']);
        $this->navBar('announcements');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->title('Test | CakePHP Jquery');
    }

    /**
     * View method
     *
     * @param string|null $id Tag id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function reaction($announcement_id)
    {
        $this->loadModel('Announcements');

        $announcement = $this->Announcements->find('all', 
                   array('conditions'=>array('Announcements.announcement_id'=>$announcement_id)));

        $row = $announcement->first();

        if ($this->request->is(['post', 'put'])) {
            $this->Announcements->patchEntity($announcement, $this->request->getData());
            if ($this->Announcements->save($announcement)) {
                $this->Flash->success(__('Your article has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your article.'));
        }

        $this->set('announcement', $announcement);
        $this->set('row', $row);
    }

    public function saveReaction() {

        $this->log('made here');

        $this->layout = false;
        $this->autoRender = false;

        $this->loadModel('Tests');

        $test = $this->Tests->newEntity();

        if ($this->request->is('post')) {
            $test->test = $this->request->data('reaction');
            if($this->Tests->save($test)){

            }
            else {
                $this->log($test->errors());
            }
        }
    }

    public function isAuthorized($user) {

    if (in_array($this->request->action, ['testSaveNoLoading','reaction','saveReaction'])) {
        return true;
    }

        return parent::isAuthorized($user);
    }
}
