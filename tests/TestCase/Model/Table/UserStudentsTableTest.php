<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserStudentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserStudentsTable Test Case
 */
class UserStudentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserStudentsTable
     */
    public $UserStudents;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.UserStudents',
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
        $config = TableRegistry::getTableLocator()->exists('UserStudents') ? [] : ['className' => UserStudentsTable::class];
        $this->UserStudents = TableRegistry::getTableLocator()->get('UserStudents', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserStudents);

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
