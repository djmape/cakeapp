<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HomeCarouselImgsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HomeCarouselImgsTable Test Case
 */
class HomeCarouselImgsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\HomeCarouselImgsTable
     */
    public $HomeCarouselImgs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.HomeCarouselImgs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('HomeCarouselImgs') ? [] : ['className' => HomeCarouselImgsTable::class];
        $this->HomeCarouselImgs = TableRegistry::getTableLocator()->get('HomeCarouselImgs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->HomeCarouselImgs);

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
