<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EventPhotosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EventPhotosTable Test Case
 */
class EventPhotosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EventPhotosTable
     */
    public $EventPhotos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.EventPhotos',
        'app.Events'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('EventPhotos') ? [] : ['className' => EventPhotosTable::class];
        $this->EventPhotos = TableRegistry::getTableLocator()->get('EventPhotos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EventPhotos);

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
