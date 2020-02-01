<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ForumTopics Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $ForumTopicCreatedByUsers
 * @property \App\Model\Table\ForumCategoriesTable|\Cake\ORM\Association\BelongsTo $ForumCategories
 *
 * @method \App\Model\Entity\ForumTopic get($primaryKey, $options = [])
 * @method \App\Model\Entity\ForumTopic newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ForumTopic[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ForumTopic|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumTopic saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumTopic patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ForumTopic[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ForumTopic findOrCreate($search, callable $callback = null, $options = [])
 */
class ForumTopicsTable extends Table
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

        $this->setTable('forum_topics');
        $this->setDisplayField('forum_topic_id');
        $this->setPrimaryKey('forum_topic_id');

        $this->belongsTo('Users', [
            'foreignKey' => 'forum_topic_created_by_user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ForumCategories', [
            'foreignKey' => 'forum_topic_category_id',
            'joinType' => 'INNER'
        ]);

        $this->hasOne('ForumTopicDetails', [
            'foreignKey' => 'forum_topic_detail_topic_id'
        ]);

        $this->hasMany('ForumDiscussions', [
            'foreignKey' => 'forum_discussion_topic_id'
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
            ->integer('forum_topic_id')
            ->allowEmptyString('forum_topic_id', 'create');

        $validator
            ->scalar('forum_topic_name')
            ->maxLength('forum_topic_name', 255)
            ->requirePresence('forum_topic_name', 'create')
            ->allowEmptyString('forum_topic_name', false);

        $validator
            ->dateTime('forum_topic_created')
            ->allowEmptyDateTime('forum_topic_created', false);

        $validator
            ->dateTime('forum_topic_modified')
            ->allowEmptyDateTime('forum_topic_modified', false);

        $validator
            ->integer('forum_topic_active')
            ->allowEmptyString('forum_topic_active', false);

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
        $rules->add($rules->existsIn(['forum_topic_created_by_user_id'], 'Users'));
        $rules->add($rules->existsIn(['forum_topic_category_id'], 'ForumCategories'));

        return $rules;
    }
}
