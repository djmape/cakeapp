<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmployeePositions Model
 *
 * @method \App\Model\Entity\EmployeePosition get($primaryKey, $options = [])
 * @method \App\Model\Entity\EmployeePosition newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EmployeePosition[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EmployeePosition|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmployeePosition saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmployeePosition patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EmployeePosition[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EmployeePosition findOrCreate($search, callable $callback = null, $options = [])
 */
class EmployeePositionsTable extends Table
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

        $this->setTable('employee_positions');
        $this->setDisplayField('employee_position_id');
        $this->setPrimaryKey('employee_position_id');

        $this->hasMany('Employees', [
            'className' => 'employee_position',
            'foreignKey' => 'employee_position_id'
        ]);

        $this->hasMany('EmployeePositions', [
            'className' => 'employee_position',
            'foreignKey' => 'employee_position_id'
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
