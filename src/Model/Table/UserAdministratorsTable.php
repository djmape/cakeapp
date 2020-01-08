<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserAdministrators Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\UserAdministrator get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserAdministrator newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserAdministrator[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserAdministrator|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserAdministrator saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserAdministrator patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserAdministrator[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserAdministrator findOrCreate($search, callable $callback = null, $options = [])
 */
class UserAdministratorsTable extends Table
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

        $this->setTable('user_administrators');
        $this->setDisplayField('admin_id');
        $this->setPrimaryKey('admin_id');

        $this->belongsTo('Users', [
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
            ->integer('admin_id')
            ->allowEmptyString('admin_id', 'create');

        $validator
            ->scalar('admin_lastname')
            ->maxLength('admin_lastname', 200)
            ->requirePresence('admin_lastname', 'create')
            ->allowEmptyString('admin_lastname', false);

        $validator
            ->scalar('admin_firstname')
            ->maxLength('admin_firstname', 200)
            ->requirePresence('admin_firstname', 'create')
            ->allowEmptyString('admin_firstname', false);

        $validator
            ->scalar('admin_middlename')
            ->maxLength('admin_middlename', 200)
            ->allowEmptyString('admin_middlename');

        $validator
            ->scalar('admin_photo')
            ->maxLength('admin_photo', 1000)
            ->requirePresence('admin_photo', 'create')
            ->allowEmptyString('admin_photo', false);

        $validator
            ->integer('admin_active')
            ->requirePresence('admin_active', 'create')
            ->allowEmptyString('admin_active', false);

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
