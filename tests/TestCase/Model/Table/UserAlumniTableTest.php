<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserAlumniTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserAlumniTable Test Case
 */
class UserAlumniTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserAlumniTable
     */
    public $UserAlumni;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.UserAlumni',
        'app.Courses',
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
        $config = TableRegistry::getTableLocator()->exists('UserAlumni') ? [] : ['className' => UserAlumniTable::class];
        $this->UserAlumni = TableRegistry::getTableLocator()->get('UserAlumni', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserAlumni);

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
