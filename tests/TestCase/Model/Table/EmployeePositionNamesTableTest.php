<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EmployeePositionNamesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EmployeePositionNamesTable Test Case
 */
class EmployeePositionNamesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EmployeePositionNamesTable
     */
    public $EmployeePositionNames;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::getTableLocator()->exists('EmployeePositionNames') ? [] : ['className' => EmployeePositionNamesTable::class];
        $this->EmployeePositionNames = TableRegistry::getTableLocator()->get('EmployeePositionNames', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EmployeePositionNames);

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
