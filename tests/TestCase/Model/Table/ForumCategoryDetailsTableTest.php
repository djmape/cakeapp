<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ForumCategoryDetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ForumCategoryDetailsTable Test Case
 */
class ForumCategoryDetailsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ForumCategoryDetailsTable
     */
    public $ForumCategoryDetails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ForumCategoryDetails',
        'app.ForumCategories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ForumCategoryDetails') ? [] : ['className' => ForumCategoryDetailsTable::class];
        $this->ForumCategoryDetails = TableRegistry::getTableLocator()->get('ForumCategoryDetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ForumCategoryDetails);

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
