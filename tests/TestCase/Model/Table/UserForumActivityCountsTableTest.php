<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserForumActivityCountsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserForumActivityCountsTable Test Case
 */
class UserForumActivityCountsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserForumActivityCountsTable
     */
    public $UserForumActivityCounts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.UserForumActivityCounts',
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
        $config = TableRegistry::getTableLocator()->exists('UserForumActivityCounts') ? [] : ['className' => UserForumActivityCountsTable::class];
        $this->UserForumActivityCounts = TableRegistry::getTableLocator()->get('UserForumActivityCounts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserForumActivityCounts);

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
