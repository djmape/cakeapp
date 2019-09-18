<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Offices Model
 *
 * @method \App\Model\Entity\Office get($primaryKey, $options = [])
 * @method \App\Model\Entity\Office newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Office[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Office|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Office saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Office patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Office[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Office findOrCreate($search, callable $callback = null, $options = [])
 */
class OfficesTable extends Table
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

        $this->setTable('offices');
        $this->setDisplayField('office_id');
        $this->setPrimaryKey('office_id');
        
        $this->hasMany('OfficeEmployees', [
            'className' => 'office',
            'foreignKey' => 'office_id'
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
            ->integer('office_id')
            ->allowEmptyString('office_id', 'create');

        $validator
            ->scalar('office_name')
            ->maxLength('office_name', 255)
            ->requirePresence('office_name', 'create')
            ->allowEmptyString('office_name', false);

        $validator
            ->scalar('office_description')
            ->maxLength('office_description', 2550)
            ->requirePresence('office_description', 'create')
            ->allowEmptyString('office_description', false);

        $validator
            ->integer('active')
            ->requirePresence('active', 'create')
            ->allowEmptyString('active', false);

        $validator
            ->scalar('office_photo')
            ->maxLength('office_photo', 1000)
            ->allowEmptyString('office_photo');

        $validator
            ->integer('priority')
            ->requirePresence('priority', 'create')
            ->allowEmptyString('priority', false);

        return $validator;
    }
}
