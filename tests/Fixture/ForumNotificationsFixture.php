<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ForumNotificationsFixture
 */
class ForumNotificationsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'forum_notification_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'user_notification_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'forum_notification_sender_user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'forum_notification_type_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'forum_notification_discussion_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'forum_notification_reply_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_forum_notification_user_notification_id' => ['type' => 'index', 'columns' => ['user_notification_id'], 'length' => []],
            'fk_forum_notification_sender_user_id' => ['type' => 'index', 'columns' => ['forum_notification_sender_user_id'], 'length' => []],
            'fk_forum_notification_type_id' => ['type' => 'index', 'columns' => ['forum_notification_type_id'], 'length' => []],
            'fk_forum_notification_discussion_id' => ['type' => 'index', 'columns' => ['forum_notification_discussion_id'], 'length' => []],
            'fk_forum_notification_reply_id' => ['type' => 'index', 'columns' => ['forum_notification_reply_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['forum_notification_id'], 'length' => []],
            'fk_forum_notification_discussion_id' => ['type' => 'foreign', 'columns' => ['forum_notification_discussion_id'], 'references' => ['forum_discussions', 'forum_discussion_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_forum_notification_reply_id' => ['type' => 'foreign', 'columns' => ['forum_notification_reply_id'], 'references' => ['forum_replies', 'forum_reply_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_forum_notification_sender_user_id' => ['type' => 'foreign', 'columns' => ['forum_notification_sender_user_id'], 'references' => ['users', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_forum_notification_type_id' => ['type' => 'foreign', 'columns' => ['forum_notification_type_id'], 'references' => ['forum_notification_types', 'forum_notification_type_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_forum_notification_user_notification_id' => ['type' => 'foreign', 'columns' => ['user_notification_id'], 'references' => ['user_notifications', 'user_notification_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'forum_notification_id' => 1,
                'user_notification_id' => 1,
                'forum_notification_sender_user_id' => 1,
                'forum_notification_type_id' => 1,
                'forum_notification_discussion_id' => 1,
                'forum_notification_reply_id' => 1
            ],
        ];
        parent::init();
    }
}
