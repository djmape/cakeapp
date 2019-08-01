<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EmployeePositionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EmployeePositionsTable Test Case
 */
class EmployeePositionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EmployeePositionsTable
     */
    public $EmployeePositions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.EmployeePositions',
        'app.Employees'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('EmployeePositions') ? [] : ['className' => EmployeePositionsTable::class];
        $this->EmployeePositions = TableRegistry::getTableLocator()->get('EmployeePositions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EmployeePositions);

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
}
