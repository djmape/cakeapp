<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OfficeEmployees Model
 *
 * @property \App\Model\Table\OfficesTable|\Cake\ORM\Association\BelongsTo $Offices
 * @property \App\Model\Table\EmployeesTable|\Cake\ORM\Association\BelongsTo $Employees
 * @property \App\Model\Table\OfficePositionsTable|\Cake\ORM\Association\BelongsTo $OfficePositions
 *
 * @method \App\Model\Entity\OfficeEmployee get($primaryKey, $options = [])
 * @method \App\Model\Entity\OfficeEmployee newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OfficeEmployee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OfficeEmployee|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OfficeEmployee saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OfficeEmployee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OfficeEmployee[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OfficeEmployee findOrCreate($search, callable $callback = null, $options = [])
 */
class OfficeEmployeesTable extends Table
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

        $this->setTable('office_employees');
        $this->setDisplayField('office_employees_id');
        $this->setPrimaryKey('office_employees_id');

        $this->belongsTo('Offices', [
            'foreignKey' => 'office_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Employees', [
            'foreignKey' => 'employee_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('OfficePositions', [
            'foreignKey' => 'office_position_id',
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
            ->integer('office_employees_id')
            ->allowEmptyString('office_employees_id', 'create');

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
        $rules->add($rules->existsIn(['office_id'], 'Offices'));
        $rules->add($rules->existsIn(['employee_id'], 'Employees'));
        $rules->add($rules->existsIn(['office_position_id'], 'OfficePositions'));

        return $rules;
    }
}
