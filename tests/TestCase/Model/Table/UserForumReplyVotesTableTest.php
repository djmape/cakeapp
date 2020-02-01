<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserForumReplyVotesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserForumReplyVotesTable Test Case
 */
class UserForumReplyVotesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserForumReplyVotesTable
     */
    public $UserForumReplyVotes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.UserForumReplyVotes',
        'app.ForumReplies',
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
        $config = TableRegistry::getTableLocator()->exists('UserForumReplyVotes') ? [] : ['className' => UserForumReplyVotesTable::class];
        $this->UserForumReplyVotes = TableRegistry::getTableLocator()->get('UserForumReplyVotes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserForumReplyVotes);

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
