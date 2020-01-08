<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserPostActivitiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserPostActivitiesTable Test Case
 */
class UserPostActivitiesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserPostActivitiesTable
     */
    public $UserPostActivities;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.UserPostActivities',
        'app.Posts',
        'app.Users',
        'app.UserPostActivityTypes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('UserPostActivities') ? [] : ['className' => UserPostActivitiesTable::class];
        $this->UserPostActivities = TableRegistry::getTableLocator()->get('UserPostActivities', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserPostActivities);

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
