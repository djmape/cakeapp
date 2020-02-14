<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ForumNotificationTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ForumNotificationTypesTable Test Case
 */
class ForumNotificationTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ForumNotificationTypesTable
     */
    public $ForumNotificationTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ForumNotificationTypes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ForumNotificationTypes') ? [] : ['className' => ForumNotificationTypesTable::class];
        $this->ForumNotificationTypes = TableRegistry::getTableLocator()->get('ForumNotificationTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ForumNotificationTypes);

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
