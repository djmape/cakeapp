<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrganizationOfficersPositions Model
 *
 * @method \App\Model\Entity\OrganizationOfficersPosition get($primaryKey, $options = [])
 * @method \App\Model\Entity\OrganizationOfficersPosition newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OrganizationOfficersPosition[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrganizationOfficersPosition|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrganizationOfficersPosition saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrganizationOfficersPosition patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OrganizationOfficersPosition[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrganizationOfficersPosition findOrCreate($search, callable $callback = null, $options = [])
 */
class OrganizationOfficersPositionsTable extends Table
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

        $this->setTable('organization_officers_positions');
        $this->setDisplayField('officers_position_id');
        $this->setPrimaryKey('officers_position_id');

        $this->hasMany('OrganizationOfficers', [
            'className' => 'organization_officers_position',
            'foreignKey' => 'officers_position_id'
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
            ->integer('officers_position_id')
            ->allowEmptyString('officers_position_id', 'create');

        $validator
            ->scalar('officers_position_name')
            ->maxLength('officers_position_name', 255)
            ->requirePresence('officers_position_name', 'create')
            ->allowEmptyString('officers_position_name', false);

        $validator
            ->integer('officers_position_priority')
            ->requirePresence('officers_position_priority', 'create')
            ->allowEmptyString('officers_position_priority', false);

        $validator
            ->integer('active')
            ->requirePresence('active', 'create')
            ->allowEmptyString('active', false);

        return $validator;
    }
}
