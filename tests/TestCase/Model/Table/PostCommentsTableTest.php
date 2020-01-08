<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PostCommentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PostCommentsTable Test Case
 */
class PostCommentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PostCommentsTable
     */
    public $PostComments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.PostComments',
        'app.Users',
        'app.Posts',
        'app.UserPostActivities',
        'app.PostCommentContents'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PostComments') ? [] : ['className' => PostCommentsTable::class];
        $this->PostComments = TableRegistry::getTableLocator()->get('PostComments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PostComments);

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
