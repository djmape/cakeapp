<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ForumTopicDetails Model
 *
 * @property \App\Model\Table\ForumTopicsTable|\Cake\ORM\Association\BelongsTo $ForumTopics
 *
 * @method \App\Model\Entity\ForumTopicDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\ForumTopicDetail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ForumTopicDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ForumTopicDetail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumTopicDetail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumTopicDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ForumTopicDetail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ForumTopicDetail findOrCreate($search, callable $callback = null, $options = [])
 */
class ForumTopicDetailsTable extends Table
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

        $this->setTable('forum_topic_details');
        $this->setDisplayField('forum_topic_detail_id');
        $this->setPrimaryKey('forum_topic_detail_id');

        $this->belongsTo('ForumTopics', [
            'foreignKey' => 'forum_topic_detail_topic_id',
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
            ->integer('forum_topic_detail_id')
            ->allowEmptyString('forum_topic_detail_id', 'create');

        $validator
            ->integer('forum_topic_detail_discussions_count')
            ->allowEmptyString('forum_topic_detail_discussions_count', false);

        $validator
            ->integer('forum_topic_detail_replies_count')
            ->allowEmptyString('forum_topic_detail_replies_count');

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
        $rules->add($rules->existsIn(['forum_topic_detail_topic_id'], 'ForumTopics'));

        return $rules;
    }
}
