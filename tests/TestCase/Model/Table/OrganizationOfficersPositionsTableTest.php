<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrganizationOfficersPositionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrganizationOfficersPositionsTable Test Case
 */
class OrganizationOfficersPositionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OrganizationOfficersPositionsTable
     */
    public $OrganizationOfficersPositions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.OrganizationOfficersPositions',
        'app.OrganizationOfficers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('OrganizationOfficersPositions') ? [] : ['className' => OrganizationOfficersPositionsTable::class];
        $this->OrganizationOfficersPositions = TableRegistry::getTableLocator()->get('OrganizationOfficersPositions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->OrganizationOfficersPositions);

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
