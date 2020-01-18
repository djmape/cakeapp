<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserActivities Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $UserActivityActivityTypes
 * @property |\Cake\ORM\Association\BelongsTo $UserActivityUsers
 * @property |\Cake\ORM\Association\BelongsTo $UserActivityPosts
 *
 * @method \App\Model\Entity\UserActivity get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserActivity newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserActivity[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserActivity|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserActivity saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserActivity patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserActivity[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserActivity findOrCreate($search, callable $callback = null, $options = [])
 */
class UserActivitiesTable extends Table
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

        $this->setTable('user_activities');
        $this->setDisplayField('user_activity_id');
        $this->setPrimaryKey('user_activity_id');

        $this->belongsTo('UserActivityTypes', [
            'foreignKey' => 'user_activity_activity_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_activity_user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Posts', [
            'foreignKey' => 'user_activity_post_id'
        ]);

        $this->hasMany('UserPostActivities', [
            'foreignKey' => 'user_post_activities_user_activity_id'
        ]);

        $this->hasMany('PostComments', [
            'foreignKey' => 'post_comment_activity_id'
        ]);

        $this->hasMany('UserPostReactions', [
            'foreignKey' => 'user_post_reactions_activity_id'
        ]);

        $this->hasMany('ForumActivities', [
            'foreignKey' => 'forum_activity_activity_id'
        ]);

        $this->hasMany('ForumCategoryActivities', [
            'foreignKey' => 'forum_category_activity_forum_activity_id'
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
            ->integer('user_activity_id')
            ->allowEmptyString('user_activity_id', 'create');

        $validator
            ->dateTime('user_activity_timestamp')
            ->allowEmptyDateTime('user_activity_timestamp', false);

        $validator
            ->integer('user_activity_reference_no')
            ->allowEmptyString('user_activity_reference_no');

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
        $rules->add($rules->existsIn(['user_activity_activity_type_id'], 'UserActivityTypes'));
        $rules->add($rules->existsIn(['user_activity_user_id'], 'Users'));
        $rules->add($rules->existsIn(['user_activity_post_id'], 'Posts'));

        return $rules;
    }
}
