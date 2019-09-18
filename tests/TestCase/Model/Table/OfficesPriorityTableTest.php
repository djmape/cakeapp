<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OfficesPriorityTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OfficesPriorityTable Test Case
 */
class OfficesPriorityTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OfficesPriorityTable
     */
    public $OfficesPriority;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.OfficesPriority',
        'app.Offices'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('OfficesPriority') ? [] : ['className' => OfficesPriorityTable::class];
        $this->OfficesPriority = TableRegistry::getTableLocator()->get('OfficesPriority', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->OfficesPriority);

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
