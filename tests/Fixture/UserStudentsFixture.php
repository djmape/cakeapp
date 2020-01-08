<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UserStudentsFixture
 */
class UserStudentsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'user_student_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'user_student_lastname' => ['type' => 'string', 'length' => 200, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'user_student_firstname' => ['type' => 'string', 'length' => 200, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'user_student_middlename' => ['type' => 'string', 'length' => 200, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'user_student_photo' => ['type' => 'string', 'length' => 1000, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'user_student_number' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'course_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_user_student_course_id' => ['type' => 'index', 'columns' => ['course_id'], 'length' => []],
            'fk_user_student_user_id' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['user_student_id'], 'length' => []],
            'user_student_number' => ['type' => 'unique', 'columns' => ['user_student_number', 'user_id'], 'length' => []],
            'fk_user_student_course_id' => ['type' => 'foreign', 'columns' => ['course_id'], 'references' => ['courses', 'course_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_user_student_user_id' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'user_student_id' => 1,
                'user_student_lastname' => 'Lorem ipsum dolor sit amet',
                'user_student_firstname' => 'Lorem ipsum dolor sit amet',
                'user_student_middlename' => 'Lorem ipsum dolor sit amet',
                'user_student_photo' => 'Lorem ipsum dolor sit amet',
                'user_student_number' => 'Lorem ipsum dolor sit amet',
                'course_id' => 1,
                'user_id' => 1
            ],
        ];
        parent::init();
    }
}
