<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ForumTopicHistory Model
 *
 * @property \App\Model\Table\ForumTopicsTable|\Cake\ORM\Association\BelongsTo $ForumTopics
 *
 * @method \App\Model\Entity\ForumTopicHistory get($primaryKey, $options = [])
 * @method \App\Model\Entity\ForumTopicHistory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ForumTopicHistory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ForumTopicHistory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumTopicHistory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumTopicHistory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ForumTopicHistory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ForumTopicHistory findOrCreate($search, callable $callback = null, $options = [])
 */
class ForumTopicHistoryTable extends Table
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

        $this->setTable('forum_topic_history');
        $this->setDisplayField('forum_topic_history_id');
        $this->setPrimaryKey('forum_topic_history_id');

        $this->belongsTo('ForumTopics', [
            'foreignKey' => 'forum_topic_id',
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
            ->integer('forum_topic_history_id')
            ->allowEmptyString('forum_topic_history_id', 'create');

        $validator
            ->scalar('forum_topic_history_topic_name')
            ->maxLength('forum_topic_history_topic_name', 200)
            ->allowEmptyString('forum_topic_history_topic_name');

        $validator
            ->dateTime('forum_topic_history_timestamp_updated')
            ->allowEmptyDateTime('forum_topic_history_timestamp_updated', false);

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
        $rules->add($rules->existsIn(['forum_topic_id'], 'ForumTopics'));

        return $rules;
    }
}
