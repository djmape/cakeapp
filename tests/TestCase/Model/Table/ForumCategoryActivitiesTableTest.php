<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ForumCategoryActivitiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ForumCategoryActivitiesTable Test Case
 */
class ForumCategoryActivitiesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ForumCategoryActivitiesTable
     */
    public $ForumCategoryActivities;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ForumCategoryActivities',
        'app.ForumActivities',
        'app.ForumCategories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ForumCategoryActivities') ? [] : ['className' => ForumCategoryActivitiesTable::class];
        $this->ForumCategoryActivities = TableRegistry::getTableLocator()->get('ForumCategoryActivities', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ForumCategoryActivities);

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
