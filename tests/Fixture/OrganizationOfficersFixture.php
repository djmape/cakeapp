<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrganizationOfficersFixture
 */
class OrganizationOfficersFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'organization_officer_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'organization_officer_name' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'organization_officer_photo' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'organization_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'officers_position_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'active' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'officer_organization_key' => ['type' => 'index', 'columns' => ['organization_id'], 'length' => []],
            'officer_position_key' => ['type' => 'index', 'columns' => ['officers_position_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['organization_officer_id'], 'length' => []],
            'officer_organization_key' => ['type' => 'foreign', 'columns' => ['organization_id'], 'references' => ['organizations', 'organization_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'officer_position_key' => ['type' => 'foreign', 'columns' => ['officers_position_id'], 'references' => ['organization_officers_positions', 'officers_position_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'organization_officer_id' => 1,
                'organization_officer_name' => 'Lorem ipsum dolor sit amet',
                'organization_officer_photo' => 'Lorem ipsum dolor sit amet',
                'organization_id' => 1,
                'officers_position_id' => 1,
                'active' => 1
            ],
        ];
        parent::init();
    }
}
