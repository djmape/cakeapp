<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Employees Model
 *
 * @property \App\Model\Table\EmployeePositionNamesTable|\Cake\ORM\Association\BelongsTo $EmployeePositionNames
 * @property |\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Employee get($primaryKey, $options = [])
 * @method \App\Model\Entity\Employee newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Employee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Employee|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Employee saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Employee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Employee[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Employee findOrCreate($search, callable $callback = null, $options = [])
 */
class EmployeesTable extends Table
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

        $this->setTable('employees');
        $this->setDisplayField('employee_id');
        $this->setPrimaryKey('employee_id');

        $this->belongsTo('EmployeePositionNames', [
            'foreignKey' => 'employee_position_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);

        $this->hasMany('OfficeEmployees', [
            'className' => 'employee',
            'foreignKey' => 'employee_id'
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
            ->integer('employee_id')
            ->allowEmptyString('employee_id', 'create');

        $validator
            ->scalar('employee_lastname')
            ->maxLength('employee_lastname', 255)
            ->requirePresence('employee_lastname', 'create')
            ->allowEmptyString('employee_lastname', false);

        $validator
            ->scalar('employee_firstname')
            ->maxLength('employee_firstname', 255)
            ->requirePresence('employee_firstname', 'create')
            ->allowEmptyString('employee_firstname', false);

        $validator
            ->scalar('employee_middlename')
            ->maxLength('employee_middlename', 255)
            ->allowEmptyString('employee_middlename');

        $validator
            ->scalar('employee_type')
            ->maxLength('employee_type', 255)
            ->requirePresence('employee_type', 'create')
            ->allowEmptyString('employee_type', false);

        $validator
            ->scalar('employee_photo')
            ->maxLength('employee_photo', 255)
            ->requirePresence('employee_photo', 'create')
            ->allowEmptyString('employee_photo', false);

        $validator
            ->scalar('employee_email')
            ->maxLength('employee_email', 255)
            ->allowEmptyString('employee_email');

        $validator
            ->integer('active')
            ->requirePresence('active', 'create')
            ->allowEmptyString('active', false);

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
        $rules->add($rules->existsIn(['employee_position_id'], 'EmployeePositionNames'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
