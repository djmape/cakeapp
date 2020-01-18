<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ForumRepliesFixture
 */
class ForumRepliesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'forum_reply_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'forum_reply_created' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'forum_reply_updated' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'forum_reply_active' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'forum_reply_created_by_user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'forum_discussion_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_forum_reply_created_by_user_id' => ['type' => 'index', 'columns' => ['forum_reply_created_by_user_id'], 'length' => []],
            'fk_forum_reply_discussion_id' => ['type' => 'index', 'columns' => ['forum_discussion_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['forum_reply_id'], 'length' => []],
            'fk_forum_reply_discussion_id' => ['type' => 'foreign', 'columns' => ['forum_discussion_id'], 'references' => ['forum_discussions', 'forum_discussion_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'forum_reply_id' => 1,
                'forum_reply_created' => 1579086857,
                'forum_reply_updated' => 1579086857,
                'forum_reply_active' => 1,
                'forum_reply_created_by_user_id' => 1,
                'forum_discussion_id' => 1
            ],
        ];
        parent::init();
    }
}
