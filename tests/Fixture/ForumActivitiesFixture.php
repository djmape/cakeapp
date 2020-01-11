<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ForumActivitiesFixture
 */
class ForumActivitiesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'forum_activity_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'forum_activity_created' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'forum_activity_type_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'forum_activity_user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'forum_activity_activity_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_forum_activity_type_id' => ['type' => 'index', 'columns' => ['forum_activity_type_id'], 'length' => []],
            'fk_forum_activity_user_id' => ['type' => 'index', 'columns' => ['forum_activity_user_id'], 'length' => []],
            'fk_forum_activity_activity_id' => ['type' => 'index', 'columns' => ['forum_activity_activity_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['forum_activity_id'], 'length' => []],
            'fk_forum_activity_activity_id' => ['type' => 'foreign', 'columns' => ['forum_activity_activity_id'], 'references' => ['user_activities', 'user_activity_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_forum_activity_type_id' => ['type' => 'foreign', 'columns' => ['forum_activity_type_id'], 'references' => ['forum_activity_types', 'forum_activity_type_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_forum_activity_user_id' => ['type' => 'foreign', 'columns' => ['forum_activity_user_id'], 'references' => ['users', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'forum_activity_id' => 1,
                'forum_activity_created' => 1578560080,
                'forum_activity_type_id' => 1,
                'forum_activity_user_id' => 1,
                'forum_activity_activity_id' => 1
            ],
        ];
        parent::init();
    }
}
