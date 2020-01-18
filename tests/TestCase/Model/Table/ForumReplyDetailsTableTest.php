<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ForumReplyDetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ForumReplyDetailsTable Test Case
 */
class ForumReplyDetailsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ForumReplyDetailsTable
     */
    public $ForumReplyDetails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ForumReplyDetails',
        'app.ForumReplies'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ForumReplyDetails') ? [] : ['className' => ForumReplyDetailsTable::class];
        $this->ForumReplyDetails = TableRegistry::getTableLocator()->get('ForumReplyDetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ForumReplyDetails);

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
