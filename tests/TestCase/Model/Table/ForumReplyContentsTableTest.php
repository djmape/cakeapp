<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ForumReplyContentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ForumReplyContentsTable Test Case
 */
class ForumReplyContentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ForumReplyContentsTable
     */
    public $ForumReplyContents;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ForumReplyContents',
        'app.ForumReplyContentForumReplies'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ForumReplyContents') ? [] : ['className' => ForumReplyContentsTable::class];
        $this->ForumReplyContents = TableRegistry::getTableLocator()->get('ForumReplyContents', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ForumReplyContents);

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
