<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserActivityTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserActivityTypesTable Test Case
 */
class UserActivityTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserActivityTypesTable
     */
    public $UserActivityTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.UserActivityTypes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('UserActivityTypes') ? [] : ['className' => UserActivityTypesTable::class];
        $this->UserActivityTypes = TableRegistry::getTableLocator()->get('UserActivityTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserActivityTypes);

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
