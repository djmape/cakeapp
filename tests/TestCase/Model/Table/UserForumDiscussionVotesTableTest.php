<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserForumDiscussionVotesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserForumDiscussionVotesTable Test Case
 */
class UserForumDiscussionVotesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserForumDiscussionVotesTable
     */
    public $UserForumDiscussionVotes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.UserForumDiscussionVotes',
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
        $config = TableRegistry::getTableLocator()->exists('UserForumDiscussionVotes') ? [] : ['className' => UserForumDiscussionVotesTable::class];
        $this->UserForumDiscussionVotes = TableRegistry::getTableLocator()->get('UserForumDiscussionVotes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserForumDiscussionVotes);

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
