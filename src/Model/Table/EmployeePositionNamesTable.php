<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmployeePositionNames Model
 *
 * @method \App\Model\Entity\EmployeePositionName get($primaryKey, $options = [])
 * @method \App\Model\Entity\EmployeePositionName newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EmployeePositionName[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EmployeePositionName|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmployeePositionName saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmployeePositionName patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EmployeePositionName[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EmployeePositionName findOrCreate($search, callable $callback = null, $options = [])
 */
class EmployeePositionNamesTable extends Table
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

        $this->setTable('employee_position_names');
        $this->setDisplayField('employee_position_id');
        $this->setPrimaryKey('employee_position_id');

        $this->hasMany('User_Employees', [
            'className' => 'employee_position',
            'foreignKey' => 'user_employee_position_id'
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
            ->integer('employee_position_id')
            ->allowEmptyString('employee_position_id', 'create');

        $validator
            ->scalar('employee_position_name')
            ->maxLength('employee_position_name', 255)
            ->requirePresence('employee_position_name', 'create')
            ->allowEmptyString('employee_position_name', false);

        $validator
            ->integer('employee_position_priority')
            ->requirePresence('employee_position_priority', 'create')
            ->allowEmptyString('employee_position_priority', false);

        $validator
            ->integer('active')
            ->requirePresence('active', 'create')
            ->allowEmptyString('active', false);

        return $validator;
    }
}
