<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ForumActivities Model
 *
 * @property \App\Model\Table\ForumActivityTypesTable|\Cake\ORM\Association\BelongsTo $ForumActivityTypes
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\UserActivitiesTable|\Cake\ORM\Association\BelongsTo $UserActivities
 *
 * @method \App\Model\Entity\ForumActivity get($primaryKey, $options = [])
 * @method \App\Model\Entity\ForumActivity newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ForumActivity[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ForumActivity|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumActivity saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumActivity patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ForumActivity[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ForumActivity findOrCreate($search, callable $callback = null, $options = [])
 */
class ForumActivitiesTable extends Table
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

        $this->setTable('forum_activities');
        $this->setDisplayField('forum_activity_id');
        $this->setPrimaryKey('forum_activity_id');

        $this->belongsTo('ForumActivityTypes', [
            'foreignKey' => 'forum_activity_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'forum_activity_user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('UserActivities', [
            'foreignKey' => 'forum_activity_activity_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('ForumCategoryActivities', [
            'foreignKey' => 'forum_category_activity_forum_activity_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('ForumTopicActivities', [
            'foreignKey' => 'forum_topic_activity_forum_activity_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('ForumDiscussionActivities', [
            'foreignKey' => 'forum_discussion_activity_forum_activity_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('ForumReplyActivities', [
            'foreignKey' => 'forum_reply_activity_forum_activity_id',
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
            ->integer('forum_activity_id')
            ->allowEmptyString('forum_activity_id', 'create');

        $validator
            ->dateTime('forum_activity_created')
            ->allowEmptyDateTime('forum_activity_created', false);

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
        $rules->add($rules->existsIn(['forum_activity_type_id'], 'ForumActivityTypes'));
        $rules->add($rules->existsIn(['forum_activity_user_id'], 'Users'));
        $rules->add($rules->existsIn(['forum_activity_activity_id'], 'UserActivities'));

        return $rules;
    }
}
