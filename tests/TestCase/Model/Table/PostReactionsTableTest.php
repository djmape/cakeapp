<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PostReactionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PostReactionsTable Test Case
 */
class PostReactionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PostReactionsTable
     */
    public $PostReactions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.PostReactions',
        'app.Posts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PostReactions') ? [] : ['className' => PostReactionsTable::class];
        $this->PostReactions = TableRegistry::getTableLocator()->get('PostReactions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PostReactions);

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
