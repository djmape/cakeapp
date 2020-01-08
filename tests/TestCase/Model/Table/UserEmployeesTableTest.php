<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserEmployeesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserEmployeesTable Test Case
 */
class UserEmployeesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserEmployeesTable
     */
    public $UserEmployees;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.UserEmployees',
        'app.Users',
        'app.EmployeePositionNames'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('UserEmployees') ? [] : ['className' => UserEmployeesTable::class];
        $this->UserEmployees = TableRegistry::getTableLocator()->get('UserEmployees', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserEmployees);

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
