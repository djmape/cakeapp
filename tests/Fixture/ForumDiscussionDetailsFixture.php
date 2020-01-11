<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ForumDiscussionDetailsFixture
 */
class ForumDiscussionDetailsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'forum_discussion_detail_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'forum_discussion_detail_replies_count' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'forum_discussion_detail_discussion_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_forum_discussion_detail_discussion_id' => ['type' => 'index', 'columns' => ['forum_discussion_detail_discussion_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['forum_discussion_detail_id'], 'length' => []],
            'fk_forum_discussion_detail_discussion_id' => ['type' => 'foreign', 'columns' => ['forum_discussion_detail_discussion_id'], 'references' => ['forum_discussions', 'forum_discussion_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'forum_discussion_detail_id' => 1,
                'forum_discussion_detail_replies_count' => 1,
                'forum_discussion_detail_discussion_id' => 1
            ],
        ];
        parent::init();
    }
}
