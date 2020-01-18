<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Posts Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\PostTypesTable|\Cake\ORM\Association\BelongsTo $PostTypes
 *
 * @method \App\Model\Entity\Post get($primaryKey, $options = [])
 * @method \App\Model\Entity\Post newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Post[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Post|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Post saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Post patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Post[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Post findOrCreate($search, callable $callback = null, $options = [])
 */
class PostsTable extends Table
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

        $this->setTable('posts');
        $this->setDisplayField('post_id');
        $this->setPrimaryKey('post_id');

        $this->belongsTo('Users', [
            'foreignKey' => 'post_user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('PostTypes', [
            'foreignKey' => 'post_post_type_id',
            'joinType' => 'INNER'
        ]);
        
        $this->hasOne('Announcements', [
            'foreignKey' => 'announcement_post_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('PostComments', [
            'foreignKey' => 'post_comment_post_id'
        ]);

        $this->hasMany('UserPostReactions', [
            'foreignKey' => 'user_post_reaction_post_id'
        ]);

        $this->hasMany('UserActivities', [
            'foreignKey' => 'user_activity_post_id'
        ]);

        $this->hasMany('UserPostActivities', [
            'foreignKey' => 'user_post_activity_post_id'
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
            ->integer('post_id')
            ->allowEmptyString('post_id', 'create');

        $validator
            ->dateTime('post_created')
            ->allowEmptyDateTime('post_created', false);

        $validator
            ->dateTime('post_modified')
            ->allowEmptyDateTime('post_modified', false);

        $validator
            ->integer('post_active')
            ->requirePresence('post_active', 'create')
            ->allowEmptyString('post_active', false);

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
        $rules->add($rules->existsIn(['post_user_id'], 'Users'));
        $rules->add($rules->existsIn(['post_post_type_id'], 'PostTypes'));

        return $rules;
    }
}
