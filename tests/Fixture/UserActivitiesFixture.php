<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UserActivitiesFixture
 */
class UserActivitiesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'user_activity_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'user_activity_timestamp' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'user_activity_activity_type_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'user_activity_user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'user_activity_reference_no' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'user_activity_post_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_user_activity_activity_type_id' => ['type' => 'index', 'columns' => ['user_activity_activity_type_id'], 'length' => []],
            'fk_user_activity_user_id' => ['type' => 'index', 'columns' => ['user_activity_user_id'], 'length' => []],
            'fk_user_activity_post_id' => ['type' => 'index', 'columns' => ['user_activity_post_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['user_activity_id'], 'length' => []],
            'fk_user_activity_activity_type_id' => ['type' => 'foreign', 'columns' => ['user_activity_activity_type_id'], 'references' => ['user_activity_types', 'user_activity_type_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_user_activity_post_id' => ['type' => 'foreign', 'columns' => ['user_activity_post_id'], 'references' => ['posts', 'post_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_user_activity_user_id' => ['type' => 'foreign', 'columns' => ['user_activity_user_id'], 'references' => ['users', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'user_activity_id' => 1,
                'user_activity_timestamp' => 1578393225,
                'user_activity_activity_type_id' => 1,
                'user_activity_user_id' => 1,
                'user_activity_reference_no' => 1,
                'user_activity_post_id' => 1
            ],
        ];
        parent::init();
    }
}
