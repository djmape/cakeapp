<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OfficePositions Model
 *
 * @method \App\Model\Entity\OfficePosition get($primaryKey, $options = [])
 * @method \App\Model\Entity\OfficePosition newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OfficePosition[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OfficePosition|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OfficePosition saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OfficePosition patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OfficePosition[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OfficePosition findOrCreate($search, callable $callback = null, $options = [])
 */
class OfficePositionsTable extends Table
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

        $this->setTable('office_positions');
        $this->setDisplayField('office_position_id');
        $this->setPrimaryKey('office_position_id');

        $this->hasMany('OfficeEmployees', [
            'className' => 'office_position',
            'foreignKey' => 'office_position_id'
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
            ->integer('office_position_id')
            ->allowEmptyString('office_position_id', 'create');

        $validator
            ->scalar('office_position_name')
            ->maxLength('office_position_name', 255)
            ->requirePresence('office_position_name', 'create')
            ->allowEmptyString('office_position_name', false);

        $validator
            ->integer('office_position_priority')
            ->requirePresence('office_position_priority', 'create')
            ->allowEmptyString('office_position_priority', false);

        $validator
            ->integer('active')
            ->requirePresence('active', 'create')
            ->allowEmptyString('active', false);

        return $validator;
    }
}
