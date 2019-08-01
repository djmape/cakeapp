<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OfficeEmployeesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OfficeEmployeesTable Test Case
 */
class OfficeEmployeesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OfficeEmployeesTable
     */
    public $OfficeEmployees;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.OfficeEmployees',
        'app.Offices',
        'app.Employees',
        'app.OfficePositions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('OfficeEmployees') ? [] : ['className' => OfficeEmployeesTable::class];
        $this->OfficeEmployees = TableRegistry::getTableLocator()->get('OfficeEmployees', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->OfficeEmployees);

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
