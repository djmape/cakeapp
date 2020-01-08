<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PostReactionTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PostReactionTypesTable Test Case
 */
class PostReactionTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PostReactionTypesTable
     */
    public $PostReactionTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.PostReactionTypes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PostReactionTypes') ? [] : ['className' => PostReactionTypesTable::class];
        $this->PostReactionTypes = TableRegistry::getTableLocator()->get('PostReactionTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PostReactionTypes);

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
