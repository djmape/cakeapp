<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ForumReplyHistoryTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ForumReplyHistoryTable Test Case
 */
class ForumReplyHistoryTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ForumReplyHistoryTable
     */
    public $ForumReplyHistory;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ForumReplyHistory',
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
        $config = TableRegistry::getTableLocator()->exists('ForumReplyHistory') ? [] : ['className' => ForumReplyHistoryTable::class];
        $this->ForumReplyHistory = TableRegistry::getTableLocator()->get('ForumReplyHistory', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ForumReplyHistory);

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
