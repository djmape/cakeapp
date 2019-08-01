<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrganizationsFixture
 */
class OrganizationsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'organization_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'organization_name' => ['type' => 'string', 'length' => 2550, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'organization_acronym' => ['type' => 'string', 'length' => 2550, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'organization_mission' => ['type' => 'string', 'length' => 2550, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'organization_vision' => ['type' => 'string', 'length' => 2550, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'organization_goal' => ['type' => 'string', 'length' => 2550, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'organization_objective' => ['type' => 'string', 'length' => 2550, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'organization_photo' => ['type' => 'string', 'length' => 2550, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'organization_type' => ['type' => 'string', 'length' => 2550, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'organization_status' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'active' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['organization_id'], 'length' => []],
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
                'organization_id' => 1,
                'organization_name' => 'Lorem ipsum dolor sit amet',
                'organization_acronym' => 'Lorem ipsum dolor sit amet',
                'organization_mission' => 'Lorem ipsum dolor sit amet',
                'organization_vision' => 'Lorem ipsum dolor sit amet',
                'organization_goal' => 'Lorem ipsum dolor sit amet',
                'organization_objective' => 'Lorem ipsum dolor sit amet',
                'organization_photo' => 'Lorem ipsum dolor sit amet',
                'organization_type' => 'Lorem ipsum dolor sit amet',
                'organization_status' => 1,
                'active' => 1
            ],
        ];
        parent::init();
    }
}
