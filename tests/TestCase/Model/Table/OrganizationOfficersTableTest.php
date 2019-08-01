<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrganizationOfficersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrganizationOfficersTable Test Case
 */
class OrganizationOfficersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OrganizationOfficersTable
     */
    public $OrganizationOfficers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.OrganizationOfficers',
        'app.Organizations',
        'app.OrganizationOfficersPositions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('OrganizationOfficers') ? [] : ['className' => OrganizationOfficersTable::class];
        $this->OrganizationOfficers = TableRegistry::getTableLocator()->get('OrganizationOfficers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->OrganizationOfficers);

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
