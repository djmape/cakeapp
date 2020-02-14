<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserNotificationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserNotificationsTable Test Case
 */
class UserNotificationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserNotificationsTable
     */
    public $UserNotifications;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.UserNotifications',
        'app.Users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('UserNotifications') ? [] : ['className' => UserNotificationsTable::class];
        $this->UserNotifications = TableRegistry::getTableLocator()->get('UserNotifications', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserNotifications);

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
