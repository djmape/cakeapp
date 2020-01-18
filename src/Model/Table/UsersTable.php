<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\UserTypesTable|\Cake\ORM\Association\BelongsTo $UserTypes
 * @property \App\Model\Table\ArticlesTable|\Cake\ORM\Association\HasMany $Articles
 * @property \App\Model\Table\UserAdministratorsTable|\Cake\ORM\Association\HasMany $UserAdministrators
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('UserTypes', [
            'foreignKey' => 'user_type_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Articles', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('UserAdministrators', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('UserEmployees', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('UserStudents', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('UserAlumni', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasOne('UserProfiles', [
            'foreignKey' => 'user_profile_user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Posts', [
            'className' => 'post',
            'foreignKey' => 'post_user_id'
        ]);
        $this->hasOne('UserForumActivityCounts', [
            'foreignKey' => 'user_id',
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
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->allowEmptyString('email', false)
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->allowEmptyString('password', false);

        $validator
            ->scalar('user_photo')
            ->maxLength('user_photo', 1000)
            ->allowEmptyString('user_photo');

        $validator
            ->integer('active')
            ->requirePresence('active', 'create')
            ->allowEmptyString('active', false);

        $validator
            ->scalar('username')
            ->maxLength('username', 200)
            ->requirePresence('username', 'create')
            ->allowEmptyString('username', false)
            ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->existsIn(['user_type_id'], 'UserTypes'));

        return $rules;
    }
}
