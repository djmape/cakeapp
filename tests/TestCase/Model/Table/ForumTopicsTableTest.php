<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ForumTopicsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ForumTopicsTable Test Case
 */
class ForumTopicsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ForumTopicsTable
     */
    public $ForumTopics;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ForumTopics',
        'app.Users',
        'app.ForumCategories',
        'app.ForumTopicDetails'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ForumTopics') ? [] : ['className' => ForumTopicsTable::class];
        $this->ForumTopics = TableRegistry::getTableLocator()->get('ForumTopics', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ForumTopics);

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
