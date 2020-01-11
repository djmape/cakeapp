<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ForumActivitiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ForumActivitiesTable Test Case
 */
class ForumActivitiesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ForumActivitiesTable
     */
    public $ForumActivities;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ForumActivities',
        'app.ForumActivityTypes',
        'app.Users',
        'app.UserActivities'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ForumActivities') ? [] : ['className' => ForumActivitiesTable::class];
        $this->ForumActivities = TableRegistry::getTableLocator()->get('ForumActivities', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ForumActivities);

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
