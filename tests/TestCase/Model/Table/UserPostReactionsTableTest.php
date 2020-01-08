<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserPostReactionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserPostReactionsTable Test Case
 */
class UserPostReactionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserPostReactionsTable
     */
    public $UserPostReactions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.UserPostReactions',
        'app.Posts',
        'app.Users',
        'app.UserPostActivities'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('UserPostReactions') ? [] : ['className' => UserPostReactionsTable::class];
        $this->UserPostReactions = TableRegistry::getTableLocator()->get('UserPostReactions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserPostReactions);

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
