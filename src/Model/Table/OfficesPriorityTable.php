<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OfficesPriority Model
 *
 * @property \App\Model\Table\OfficesTable|\Cake\ORM\Association\BelongsTo $Offices
 *
 * @method \App\Model\Entity\OfficesPriority get($primaryKey, $options = [])
 * @method \App\Model\Entity\OfficesPriority newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OfficesPriority[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OfficesPriority|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OfficesPriority saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OfficesPriority patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OfficesPriority[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OfficesPriority findOrCreate($search, callable $callback = null, $options = [])
 */
class OfficesPriorityTable extends Table
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

        $this->setTable('offices_priority');
        $this->setDisplayField('office_priority_id');
        $this->setPrimaryKey('office_priority_id');

        $this->belongsTo('Offices', [
            'foreignKey' => 'office_id',
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
            ->integer('office_priority_id')
            ->allowEmptyString('office_priority_id', 'create');

        $validator
            ->integer('office_priority')
            ->requirePresence('office_priority', 'create')
            ->allowEmptyString('office_priority', false);

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

        return $rules;
    }
}
