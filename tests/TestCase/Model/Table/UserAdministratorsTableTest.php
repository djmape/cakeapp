<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserAdministratorsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserAdministratorsTable Test Case
 */
class UserAdministratorsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserAdministratorsTable
     */
    public $UserAdministrators;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.UserAdministrators',
        'app.Users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('UserAdministrators') ? [] : ['className' => UserAdministratorsTable::class];
        $this->UserAdministrators = TableRegistry::getTableLocator()->get('UserAdministrators', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserAdministrators);

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
