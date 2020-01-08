<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PostCommentContentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PostCommentContentsTable Test Case
 */
class PostCommentContentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PostCommentContentsTable
     */
    public $PostCommentContents;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.PostCommentContents',
        'app.PostComments'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PostCommentContents') ? [] : ['className' => PostCommentContentsTable::class];
        $this->PostCommentContents = TableRegistry::getTableLocator()->get('PostCommentContents', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PostCommentContents);

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
