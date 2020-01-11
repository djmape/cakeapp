<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ForumTopicActivitiesFixture
 */
class ForumTopicActivitiesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'forum_topic_activity_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'forum_topic_activity_forum_activity_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'forum_topic_activity_forum_topic_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_forum_topic_activity_forum_activity_id' => ['type' => 'index', 'columns' => ['forum_topic_activity_forum_activity_id'], 'length' => []],
            'fk_forum_topic_activity_forum_topic_id' => ['type' => 'index', 'columns' => ['forum_topic_activity_forum_topic_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['forum_topic_activity_id'], 'length' => []],
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
                'forum_topic_activity_id' => 1,
                'forum_topic_activity_forum_activity_id' => 1,
                'forum_topic_activity_forum_topic_id' => 1
            ],
        ];
        parent::init();
    }
}
