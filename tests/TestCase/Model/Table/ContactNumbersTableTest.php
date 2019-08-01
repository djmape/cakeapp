<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContactNumbersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContactNumbersTable Test Case
 */
class ContactNumbersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ContactNumbersTable
     */
    public $ContactNumbers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ContactNumbers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ContactNumbers') ? [] : ['className' => ContactNumbersTable::class];
        $this->ContactNumbers = TableRegistry::getTableLocator()->get('ContactNumbers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ContactNumbers);

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
