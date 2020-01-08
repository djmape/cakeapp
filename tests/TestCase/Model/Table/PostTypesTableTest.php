<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PostTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PostTypesTable Test Case
 */
class PostTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PostTypesTable
     */
    public $PostTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.PostTypes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PostTypes') ? [] : ['className' => PostTypesTable::class];
        $this->PostTypes = TableRegistry::getTableLocator()->get('PostTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PostTypes);

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
