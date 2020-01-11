<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ForumDiscussionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ForumDiscussionsTable Test Case
 */
class ForumDiscussionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ForumDiscussionsTable
     */
    public $ForumDiscussions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ForumDiscussions',
        'app.Users',
        'app.ForumDiscussionDetails'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ForumDiscussions') ? [] : ['className' => ForumDiscussionsTable::class];
        $this->ForumDiscussions = TableRegistry::getTableLocator()->get('ForumDiscussions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ForumDiscussions);

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
