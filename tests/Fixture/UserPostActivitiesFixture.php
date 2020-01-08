<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UserPostActivitiesFixture
 */
class UserPostActivitiesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'user_post_activity_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'user_post_activity_post_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'user_post_activity_user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'user_post_activity_type_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'user_post_activity_timestamp' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'user_post_activities_user_activity_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_user_post_activity_post_id' => ['type' => 'index', 'columns' => ['user_post_activity_post_id'], 'length' => []],
            'fk_user_post_activity_user_id' => ['type' => 'index', 'columns' => ['user_post_activity_user_id'], 'length' => []],
            'fk_user_post_activity_type_id' => ['type' => 'index', 'columns' => ['user_post_activity_type_id'], 'length' => []],
            'fk_user_post_activities_user_activity_id' => ['type' => 'index', 'columns' => ['user_post_activities_user_activity_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['user_post_activity_id'], 'length' => []],
            'fk_user_post_activities_user_actvity_id' => ['type' => 'foreign', 'columns' => ['user_post_activities_user_activity_id'], 'references' => ['user_activities', 'user_activity_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_user_post_activity_post_id' => ['type' => 'foreign', 'columns' => ['user_post_activity_post_id'], 'references' => ['posts', 'post_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_user_post_activity_type_id' => ['type' => 'foreign', 'columns' => ['user_post_activity_type_id'], 'references' => ['user_post_activity_types', 'user_post_activity_type_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_user_post_activity_user_id' => ['type' => 'foreign', 'columns' => ['user_post_activity_user_id'], 'references' => ['users', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'user_post_activity_id' => 1,
                'user_post_activity_post_id' => 1,
                'user_post_activity_user_id' => 1,
                'user_post_activity_type_id' => 1,
                'user_post_activity_timestamp' => 1578394431,
                'user_post_activities_user_activity_id' => 1
            ],
        ];
        parent::init();
    }
}
