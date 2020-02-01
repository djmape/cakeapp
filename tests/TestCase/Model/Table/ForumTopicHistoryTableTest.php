<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ForumTopicHistoryTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ForumTopicHistoryTable Test Case
 */
class ForumTopicHistoryTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ForumTopicHistoryTable
     */
    public $ForumTopicHistory;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ForumTopicHistory',
        'app.ForumTopics'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ForumTopicHistory') ? [] : ['className' => ForumTopicHistoryTable::class];
        $this->ForumTopicHistory = TableRegistry::getTableLocator()->get('ForumTopicHistory', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ForumTopicHistory);

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
