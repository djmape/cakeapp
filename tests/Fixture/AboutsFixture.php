<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AboutsFixture
 */
class AboutsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'about_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'about_description' => ['type' => 'string', 'length' => 2550, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'about_mission' => ['type' => 'string', 'length' => 2550, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'about_vision' => ['type' => 'string', 'length' => 2550, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'about_goals' => ['type' => 'string', 'length' => 2550, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'about_objective' => ['type' => 'string', 'length' => 2550, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'about_hymn' => ['type' => 'string', 'length' => 2550, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'about_modified' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'about_additional_info' => ['type' => 'string', 'length' => 5000, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['about_id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'about_id' => 1,
                'about_description' => 'Lorem ipsum dolor sit amet',
                'about_mission' => 'Lorem ipsum dolor sit amet',
                'about_vision' => 'Lorem ipsum dolor sit amet',
                'about_goals' => 'Lorem ipsum dolor sit amet',
                'about_objective' => 'Lorem ipsum dolor sit amet',
                'about_hymn' => 'Lorem ipsum dolor sit amet',
                'about_modified' => 1561787287,
                'about_additional_info' => 'Lorem ipsum dolor sit amet'
            ],
        ];
        parent::init();
    }
}
