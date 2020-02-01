<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UserForumReplyVotesFixture
 */
class UserForumReplyVotesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'forum_reply_vote_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'forum_reply_vote_upvote' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'forum_reply_vote_downvote' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'forum_reply_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_forum_reply_vote_forum_reply_id' => ['type' => 'index', 'columns' => ['forum_reply_id'], 'length' => []],
            'fk_forum_reply_vote_user_id' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['forum_reply_vote_id'], 'length' => []],
            'fk_forum_reply_vote_forum_reply_id' => ['type' => 'foreign', 'columns' => ['forum_reply_id'], 'references' => ['forum_replies', 'forum_reply_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_forum_reply_vote_user_id' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'forum_reply_vote_id' => 1,
                'forum_reply_vote_upvote' => 1,
                'forum_reply_vote_downvote' => 1,
                'forum_reply_id' => 1,
                'user_id' => 1
            ],
        ];
        parent::init();
    }
}
