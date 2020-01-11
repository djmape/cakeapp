<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ForumActivityTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ForumActivityTypesTable Test Case
 */
class ForumActivityTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ForumActivityTypesTable
     */
    public $ForumActivityTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ForumActivityTypes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ForumActivityTypes') ? [] : ['className' => ForumActivityTypesTable::class];
        $this->ForumActivityTypes = TableRegistry::getTableLocator()->get('ForumActivityTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ForumActivityTypes);

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
