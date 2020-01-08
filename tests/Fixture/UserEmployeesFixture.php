<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UserEmployeesFixture
 */
class UserEmployeesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'user_employee_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'user_employee_lastname' => ['type' => 'string', 'length' => 200, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'user_employee_firstname' => ['type' => 'string', 'length' => 200, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'user_employee_middlename' => ['type' => 'string', 'length' => 200, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'user_employee_photo' => ['type' => 'string', 'length' => 1000, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'user_employee_active' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'user_employee_position_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_user_employee_user_id' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
            'fk_user_employee_position_id' => ['type' => 'index', 'columns' => ['user_employee_position_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['user_employee_id'], 'length' => []],
            'fk_user_employee_position_id' => ['type' => 'foreign', 'columns' => ['user_employee_position_id'], 'references' => ['employee_position_names', 'employee_position_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_user_employee_user_id' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'user_employee_id' => 1,
                'user_employee_lastname' => 'Lorem ipsum dolor sit amet',
                'user_employee_firstname' => 'Lorem ipsum dolor sit amet',
                'user_employee_middlename' => 'Lorem ipsum dolor sit amet',
                'user_employee_photo' => 'Lorem ipsum dolor sit amet',
                'user_employee_active' => 1,
                'user_id' => 1,
                'user_employee_position_id' => 1
            ],
        ];
        parent::init();
    }
}
