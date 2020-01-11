<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ForumDiscussionsFixture
 */
class ForumDiscussionsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'forum_discussion_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'forum_discussion_title' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'forum_discussion_created' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'forum_discussion_updated' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'forum_discussion_active' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'forum_discussion_created_by_user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'forum_discussion_topic_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_forum_discussion_created_by_user_id' => ['type' => 'index', 'columns' => ['forum_discussion_created_by_user_id'], 'length' => []],
            'fk_forum_discussion_topic_id' => ['type' => 'index', 'columns' => ['forum_discussion_topic_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['forum_discussion_id'], 'length' => []],
            'fk_forum_discussion_topic_id' => ['type' => 'foreign', 'columns' => ['forum_discussion_topic_id'], 'references' => ['forum_topics', 'forum_topic_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'forum_discussion_id' => 1,
                'forum_discussion_title' => 'Lorem ipsum dolor sit amet',
                'forum_discussion_created' => 1578737929,
                'forum_discussion_updated' => 1578737929,
                'forum_discussion_active' => 1,
                'forum_discussion_created_by_user_id' => 1,
                'forum_discussion_topic_id' => 1
            ],
        ];
        parent::init();
    }
}
