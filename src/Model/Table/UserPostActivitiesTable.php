<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserPostActivities Model
 *
 * @property \App\Model\Table\PostsTable|\Cake\ORM\Association\BelongsTo $Posts
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\UserPostActivityTypesTable|\Cake\ORM\Association\BelongsTo $UserPostActivityTypes
 * @property |\Cake\ORM\Association\BelongsTo $UserActivities
 *
 * @method \App\Model\Entity\UserPostActivity get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserPostActivity newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserPostActivity[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserPostActivity|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserPostActivity saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserPostActivity patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserPostActivity[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserPostActivity findOrCreate($search, callable $callback = null, $options = [])
 */
class UserPostActivitiesTable extends Table
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

        $this->setTable('user_post_activities');
        $this->setDisplayField('user_post_activity_id');
        $this->setPrimaryKey('user_post_activity_id');

        $this->belongsTo('Posts', [
            'foreignKey' => 'user_post_activity_post_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_post_activity_user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('UserPostActivityTypes', [
            'foreignKey' => 'user_post_activity_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('UserActivities', [
            'foreignKey' => 'user_post_activities_user_activity_id'
        ]);

        $this->hasMany('UserPostReactions', [
            'foreignKey' => 'user_post_reaction_post_activity_id'
        ]);

        $this->hasMany('PostComments', [
            'foreignKey' => 'post_comment_post_activity_id'
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
            ->integer('user_post_activity_id')
            ->allowEmptyString('user_post_activity_id', 'create');

        $validator
            ->dateTime('user_post_activity_timestamp')
            ->allowEmptyDateTime('user_post_activity_timestamp', false);

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
        $rules->add($rules->existsIn(['user_post_activity_post_id'], 'Posts'));
        $rules->add($rules->existsIn(['user_post_activity_user_id'], 'Users'));
        $rules->add($rules->existsIn(['user_post_activity_type_id'], 'UserPostActivityTypes'));
        $rules->add($rules->existsIn(['user_post_activities_user_activity_id'], 'UserActivities'));

        return $rules;
    }
}
