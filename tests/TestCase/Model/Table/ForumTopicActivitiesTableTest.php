<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ForumTopicActivitiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ForumTopicActivitiesTable Test Case
 */
class ForumTopicActivitiesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ForumTopicActivitiesTable
     */
    public $ForumTopicActivities;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ForumTopicActivities',
        'app.ForumTopicActivityForumActivities',
        'app.ForumTopicActivityForumTopics'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ForumTopicActivities') ? [] : ['className' => ForumTopicActivitiesTable::class];
        $this->ForumTopicActivities = TableRegistry::getTableLocator()->get('ForumTopicActivities', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ForumTopicActivities);

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
