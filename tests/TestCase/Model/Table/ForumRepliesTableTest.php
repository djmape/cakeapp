<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ForumRepliesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ForumRepliesTable Test Case
 */
class ForumRepliesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ForumRepliesTable
     */
    public $ForumReplies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ForumReplies',
        'app.Users',
        'app.ForumDiscussions',
        'app.ForumReplyActivities',
        'app.ForumReplyDetails'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ForumReplies') ? [] : ['className' => ForumRepliesTable::class];
        $this->ForumReplies = TableRegistry::getTableLocator()->get('ForumReplies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ForumReplies);

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
