<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ForumDiscussionDetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ForumDiscussionDetailsTable Test Case
 */
class ForumDiscussionDetailsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ForumDiscussionDetailsTable
     */
    public $ForumDiscussionDetails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ForumDiscussionDetails',
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
        $config = TableRegistry::getTableLocator()->exists('ForumDiscussionDetails') ? [] : ['className' => ForumDiscussionDetailsTable::class];
        $this->ForumDiscussionDetails = TableRegistry::getTableLocator()->get('ForumDiscussionDetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ForumDiscussionDetails);

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
