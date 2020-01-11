<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ForumDiscussionActivities Model
 *
 * @property \App\Model\Table\ForumDiscussionActivityForumActivitiesTable|\Cake\ORM\Association\BelongsTo $ForumDiscussionActivityForumActivities
 * @property \App\Model\Table\ForumDiscussionActivityForumDiscussionsTable|\Cake\ORM\Association\BelongsTo $ForumDiscussionActivityForumDiscussions
 *
 * @method \App\Model\Entity\ForumDiscussionActivity get($primaryKey, $options = [])
 * @method \App\Model\Entity\ForumDiscussionActivity newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ForumDiscussionActivity[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ForumDiscussionActivity|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumDiscussionActivity saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumDiscussionActivity patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ForumDiscussionActivity[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ForumDiscussionActivity findOrCreate($search, callable $callback = null, $options = [])
 */
class ForumDiscussionActivitiesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('forum_discussion_activities');
        $this->setDisplayField('forum_discussion_activity_id');
        $this->setPrimaryKey('forum_discussion_activity_id');

        $this->belongsTo('ForumDiscussionActivityForumActivities', [
            'foreignKey' => 'forum_discussion_activity_forum_activity_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ForumDiscussionActivityForumDiscussions', [
            'foreignKey' => 'forum_discussion_activity_forum_discussion_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('forum_discussion_activity_id')
            ->allowEmptyString('forum_discussion_activity_id', 'create');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['forum_discussion_activity_forum_activity_id'], 'ForumDiscussionActivityForumActivities'));
        $rules->add($rules->existsIn(['forum_discussion_activity_forum_discussion_id'], 'ForumDiscussionActivityForumDiscussions'));

        return $rules;
    }
}
