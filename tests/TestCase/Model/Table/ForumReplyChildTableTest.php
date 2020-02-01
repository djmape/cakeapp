<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ForumReplyChildTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ForumReplyChildTable Test Case
 */
class ForumReplyChildTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ForumReplyChildTable
     */
    public $ForumReplyChild;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ForumReplyChild',
        'app.ForumChildReplies',
        'app.ForumParentReplies'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ForumReplyChild') ? [] : ['className' => ForumReplyChildTable::class];
        $this->ForumReplyChild = TableRegistry::getTableLocator()->get('ForumReplyChild', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ForumReplyChild);

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
