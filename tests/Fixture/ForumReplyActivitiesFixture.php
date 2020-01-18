<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ForumReplyActivitiesFixture
 */
class ForumReplyActivitiesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'forum_reply_activity_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'forum_reply_activity_forum_activity_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'forum_reply_activity_forum_reply_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_forum_reply_activity_forum_activity_id' => ['type' => 'index', 'columns' => ['forum_reply_activity_forum_activity_id'], 'length' => []],
            'fk_forum_reply_activity_forum_reply_id' => ['type' => 'index', 'columns' => ['forum_reply_activity_forum_reply_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['forum_reply_activity_id'], 'length' => []],
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
                'forum_reply_activity_id' => 1,
                'forum_reply_activity_forum_activity_id' => 1,
                'forum_reply_activity_forum_reply_id' => 1
            ],
        ];
        parent::init();
    }
}
