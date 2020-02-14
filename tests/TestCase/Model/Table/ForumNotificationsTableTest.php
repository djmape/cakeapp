<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ForumNotificationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ForumNotificationsTable Test Case
 */
class ForumNotificationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ForumNotificationsTable
     */
    public $ForumNotifications;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ForumNotifications',
        'app.UserNotifications',
        'app.Users',
        'app.ForumNotificationTypes',
        'app.ForumDiscussions',
        'app.ForumReplies'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ForumNotifications') ? [] : ['className' => ForumNotificationsTable::class];
        $this->ForumNotifications = TableRegistry::getTableLocator()->get('ForumNotifications', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ForumNotifications);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
