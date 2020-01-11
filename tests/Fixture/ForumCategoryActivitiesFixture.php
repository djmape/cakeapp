<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ForumCategoryActivitiesFixture
 */
class ForumCategoryActivitiesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'forum_category_activity_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'forum_category_activity_forum_activity_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'forum_category_activity_forum_category_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_forum_category_activity_forum_activity_id' => ['type' => 'index', 'columns' => ['forum_category_activity_forum_activity_id'], 'length' => []],
            'fk_forum_category_activity_forum_category_id' => ['type' => 'index', 'columns' => ['forum_category_activity_forum_category_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['forum_category_activity_id'], 'length' => []],
            'fk_forum_category_activity_forum_activity_id' => ['type' => 'foreign', 'columns' => ['forum_category_activity_forum_activity_id'], 'references' => ['forum_activities', 'forum_activity_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_forum_category_activity_forum_category_id' => ['type' => 'foreign', 'columns' => ['forum_category_activity_forum_category_id'], 'references' => ['forum_categories', 'forum_category_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'forum_category_activity_id' => 1,
                'forum_category_activity_forum_activity_id' => 1,
                'forum_category_activity_forum_category_id' => 1
            ],
        ];
        parent::init();
    }
}
