<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContactEmailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContactEmailsTable Test Case
 */
class ContactEmailsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ContactEmailsTable
     */
    public $ContactEmails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ContactEmails'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ContactEmails') ? [] : ['className' => ContactEmailsTable::class];
        $this->ContactEmails = TableRegistry::getTableLocator()->get('ContactEmails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ContactEmails);

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
