<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ForumReplyChildFixture
 */
class ForumReplyChildFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'forum_reply_child';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'forum_reply_child_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'forum_reply_child_reply_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'forum_reply_parent_reply_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_forum_reply_child_id' => ['type' => 'index', 'columns' => ['forum_reply_child_reply_id'], 'length' => []],
            'fk_forum_reply_parent_id' => ['type' => 'index', 'columns' => ['forum_reply_parent_reply_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['forum_reply_child_id'], 'length' => []],
            'fk_forum_reply_child_id' => ['type' => 'foreign', 'columns' => ['forum_reply_child_reply_id'], 'references' => ['forum_replies', 'forum_reply_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_forum_reply_parent_id' => ['type' => 'foreign', 'columns' => ['forum_reply_parent_reply_id'], 'references' => ['forum_replies', 'forum_reply_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'forum_reply_child_id' => 1,
                'forum_reply_child_reply_id' => 1,
                'forum_reply_parent_reply_id' => 1
            ],
        ];
        parent::init();
    }
}
