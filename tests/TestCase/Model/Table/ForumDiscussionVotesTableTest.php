<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ForumDiscussionVotesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ForumDiscussionVotesTable Test Case
 */
class ForumDiscussionVotesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ForumDiscussionVotesTable
     */
    public $ForumDiscussionVotes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ForumDiscussionVotes',
        'app.ForumDiscussions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ForumDiscussionVotes') ? [] : ['className' => ForumDiscussionVotesTable::class];
        $this->ForumDiscussionVotes = TableRegistry::getTableLocator()->get('ForumDiscussionVotes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ForumDiscussionVotes);

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
