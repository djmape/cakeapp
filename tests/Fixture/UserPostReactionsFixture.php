<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UserPostReactionsFixture
 */
class UserPostReactionsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'user_post_reactions_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'user_post_reaction_like' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'user_post_reaction_dislike' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'user_post_reaction_post_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'user_post_reaction_user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'user_post_reaction_post_activity_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'user_post_reactions_activity_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_user_post_reaction_post_id' => ['type' => 'index', 'columns' => ['user_post_reaction_post_id'], 'length' => []],
            'user_post_reaction_user_id' => ['type' => 'index', 'columns' => ['user_post_reaction_user_id'], 'length' => []],
            'fk_user_post_reaction_post_activity_id' => ['type' => 'index', 'columns' => ['user_post_reaction_post_activity_id'], 'length' => []],
            'fk1_user_post_reactions_activity_id' => ['type' => 'index', 'columns' => ['user_post_reactions_activity_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['user_post_reactions_id'], 'length' => []],
            'fk1_user_post_reactions_activity_id' => ['type' => 'foreign', 'columns' => ['user_post_reactions_activity_id'], 'references' => ['user_activities', 'user_activity_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_user_post_reaction_post_activity_id' => ['type' => 'foreign', 'columns' => ['user_post_reaction_post_activity_id'], 'references' => ['user_post_activities', 'user_post_activity_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_user_post_reaction_post_id' => ['type' => 'foreign', 'columns' => ['user_post_reaction_post_id'], 'references' => ['posts', 'post_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_user_post_reaction_user_id' => ['type' => 'foreign', 'columns' => ['user_post_reaction_user_id'], 'references' => ['users', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'user_post_reactions_id' => 1,
                'user_post_reaction_like' => 1,
                'user_post_reaction_dislike' => 1,
                'user_post_reaction_post_id' => 1,
                'user_post_reaction_user_id' => 1,
                'user_post_reaction_post_activity_id' => 1,
                'user_post_reactions_activity_id' => 1
            ],
        ];
        parent::init();
    }
}
