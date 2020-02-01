<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ForumDiscussionHistory Model
 *
 * @property \App\Model\Table\ForumDiscussionsTable|\Cake\ORM\Association\BelongsTo $ForumDiscussions
 *
 * @method \App\Model\Entity\ForumDiscussionHistory get($primaryKey, $options = [])
 * @method \App\Model\Entity\ForumDiscussionHistory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ForumDiscussionHistory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ForumDiscussionHistory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumDiscussionHistory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumDiscussionHistory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ForumDiscussionHistory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ForumDiscussionHistory findOrCreate($search, callable $callback = null, $options = [])
 */
class ForumDiscussionHistoryTable extends Table
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

        $this->setTable('forum_discussion_history');
        $this->setDisplayField('forum_discussion_history_id');
        $this->setPrimaryKey('forum_discussion_history_id');

        $this->belongsTo('ForumDiscussions', [
            'foreignKey' => 'forum_discussion_id',
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
            ->integer('forum_discussion_history_id')
            ->allowEmptyString('forum_discussion_history_id', 'create');

        $validator
            ->scalar('forum_discussion_history_discussion_title')
            ->maxLength('forum_discussion_history_discussion_title', 200)
            ->allowEmptyString('forum_discussion_history_discussion_title');

        $validator
            ->scalar('forum_discussion_history_discussion_content')
            ->allowEmptyString('forum_discussion_history_discussion_content');

        $validator
            ->dateTime('forum_discussion_history_timestamp_updated')
            ->allowEmptyDateTime('forum_discussion_history_timestamp_updated', false);

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
        $rules->add($rules->existsIn(['forum_discussion_id'], 'ForumDiscussions'));

        return $rules;
    }
}
