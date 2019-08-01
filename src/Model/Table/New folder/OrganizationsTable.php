<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Organizations Model
 *
 * @method \App\Model\Entity\Organization get($primaryKey, $options = [])
 * @method \App\Model\Entity\Organization newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Organization[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Organization|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Organization saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Organization patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Organization[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Organization findOrCreate($search, callable $callback = null, $options = [])
 */
class OrganizationsTable extends Table
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

        $this->setTable('organizations');
        $this->setDisplayField('organization_id');
        $this->setPrimaryKey('organization_id');
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
            ->integer('organization_id')
            ->allowEmptyString('organization_id', 'create');

        $validator
            ->scalar('organization_name')
            ->maxLength('organization_name', 255)
            ->requirePresence('organization_name', 'create')
            ->allowEmptyString('organization_name', false);

        $validator
            ->scalar('organization_acronym')
            ->maxLength('organization_acronym', 255)
            ->requirePresence('organization_acronym', 'create')
            ->allowEmptyString('organization_acronym', false);

        $validator
            ->scalar('organization_mission')
            ->maxLength('organization_mission', 255)
            ->requirePresence('organization_mission', 'create')
            ->allowEmptyString('organization_mission', false);

        $validator
            ->scalar('organization_vision')
            ->maxLength('organization_vision', 255)
            ->requirePresence('organization_vision', 'create')
            ->allowEmptyString('organization_vision', false);

        $validator
            ->scalar('organization_goal')
            ->maxLength('organization_goal', 255)
            ->requirePresence('organization_goal', 'create')
            ->allowEmptyString('organization_goal', false);

        $validator
            ->scalar('organization_objective')
            ->maxLength('organization_objective', 255)
            ->requirePresence('organization_objective', 'create')
            ->allowEmptyString('organization_objective', false);

        $validator
            ->scalar('organization_photo')
            ->maxLength('organization_photo', 255)
            ->allowEmptyString('organization_photo');

        $validator
            ->integer('organization_status')
            ->requirePresence('organization_status', 'create')
            ->allowEmptyString('organization_status', false);

        $validator
            ->scalar('organization_type')
            ->maxLength('organization_type', 255)
            ->requirePresence('organization_type', 'create')
            ->allowEmptyString('organization_type', false);

        return $validator;
    }
}
