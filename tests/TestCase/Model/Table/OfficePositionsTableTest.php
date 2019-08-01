<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OfficePositionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OfficePositionsTable Test Case
 */
class OfficePositionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OfficePositionsTable
     */
    public $OfficePositions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::getTableLocator()->exists('OfficePositions') ? [] : ['className' => OfficePositionsTable::class];
        $this->OfficePositions = TableRegistry::getTableLocator()->get('OfficePositions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->OfficePositions);

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
