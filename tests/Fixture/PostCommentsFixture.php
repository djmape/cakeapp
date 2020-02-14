<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PostCommentsFixture
 */
class PostCommentsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'post_comment_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'post_comment_timestamp' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'post_comment_user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'post_comment_post_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'post_comment_post_activity_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'user_post_reactions_activity_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'post_comment_activity_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_post_comment_user_id' => ['type' => 'index', 'columns' => ['post_comment_user_id'], 'length' => []],
            'fk_post_comment_post_id' => ['type' => 'index', 'columns' => ['post_comment_post_id'], 'length' => []],
            'fk_post_comment_post_activity_id' => ['type' => 'index', 'columns' => ['post_comment_post_activity_id'], 'length' => []],
            'fk_user_post_reactions_activity_idd' => ['type' => 'index', 'columns' => ['user_post_reactions_activity_id'], 'length' => []],
            'fk_post_comment_activity_id' => ['type' => 'index', 'columns' => ['post_comment_activity_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['post_comment_id'], 'length' => []],
            'fk_post_comment_activity_id' => ['type' => 'foreign', 'columns' => ['post_comment_activity_id'], 'references' => ['user_activities', 'user_activity_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'post_comment_id' => 1,
                'post_comment_timestamp' => 1580973114,
                'post_comment_user_id' => 1,
                'post_comment_post_id' => 1,
                'post_comment_post_activity_id' => 1,
                'user_post_reactions_activity_id' => 1,
                'post_comment_activity_id' => 1
            ],
        ];
        parent::init();
    }
}
