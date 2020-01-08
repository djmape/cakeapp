<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserEmployees Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\EmployeePositionNamesTable|\Cake\ORM\Association\BelongsTo $EmployeePositionNames
 *
 * @method \App\Model\Entity\UserEmployee get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserEmployee newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserEmployee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserEmployee|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserEmployee saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserEmployee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserEmployee[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserEmployee findOrCreate($search, callable $callback = null, $options = [])
 */
class UserEmployeesTable extends Table
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

        $this->setTable('user_employees');
        $this->setDisplayField('user_employee_id');
        $this->setPrimaryKey('user_employee_id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('EmployeePositionNames', [
            'foreignKey' => 'user_employee_position_id',
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
            ->integer('user_employee_id')
            ->allowEmptyString('user_employee_id', 'create');

        $validator
            ->scalar('user_employee_lastname')
            ->maxLength('user_employee_lastname', 200)
            ->requirePresence('user_employee_lastname', 'create')
            ->allowEmptyString('user_employee_lastname', false);

        $validator
            ->scalar('user_employee_firstname')
            ->maxLength('user_employee_firstname', 200)
            ->requirePresence('user_employee_firstname', 'create')
            ->allowEmptyString('user_employee_firstname', false);

        $validator
            ->scalar('user_employee_middlename')
            ->maxLength('user_employee_middlename', 200)
            ->allowEmptyString('user_employee_middlename');

        $validator
            ->scalar('user_employee_photo')
            ->maxLength('user_employee_photo', 1000)
            ->requirePresence('user_employee_photo', 'create')
            ->allowEmptyString('user_employee_photo', false);

        $validator
            ->integer('user_employee_active')
            ->allowEmptyString('user_employee_active', false);

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
        $rules->add($rules->existsIn(['user_employee_position_id'], 'EmployeePositionNames'));

        return $rules;
    }
}
