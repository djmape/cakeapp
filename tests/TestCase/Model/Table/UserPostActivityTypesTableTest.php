<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserPostActivityTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserPostActivityTypesTable Test Case
 */
class UserPostActivityTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserPostActivityTypesTable
     */
    public $UserPostActivityTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.UserPostActivityTypes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('UserPostActivityTypes') ? [] : ['className' => UserPostActivityTypesTable::class];
        $this->UserPostActivityTypes = TableRegistry::getTableLocator()->get('UserPostActivityTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserPostActivityTypes);

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
