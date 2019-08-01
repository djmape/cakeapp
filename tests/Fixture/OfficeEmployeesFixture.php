<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OfficeEmployeesFixture
 */
class OfficeEmployeesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'office_employees_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'office_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'employee_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'office_position_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'active' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'office_key' => ['type' => 'index', 'columns' => ['office_id'], 'length' => []],
            'office_employee_key' => ['type' => 'index', 'columns' => ['employee_id'], 'length' => []],
            'office_position_key' => ['type' => 'index', 'columns' => ['office_position_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['office_employees_id'], 'length' => []],
            'office_employee_key' => ['type' => 'foreign', 'columns' => ['employee_id'], 'references' => ['employees', 'employee_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'office_key' => ['type' => 'foreign', 'columns' => ['office_id'], 'references' => ['offices', 'office_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'office_position_key' => ['type' => 'foreign', 'columns' => ['office_position_id'], 'references' => ['office_positions', 'office_position_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'office_employees_id' => 1,
                'office_id' => 1,
                'employee_id' => 1,
                'office_position_id' => 1,
                'active' => 1
            ],
        ];
        parent::init();
    }
}
