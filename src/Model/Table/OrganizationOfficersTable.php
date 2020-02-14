<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrganizationOfficers Model
 *
 * @property \App\Model\Table\OrganizationsTable|\Cake\ORM\Association\BelongsTo $Organizations
 * @property |\Cake\ORM\Association\BelongsTo $OfficersPositions
 * @property |\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\OrganizationOfficer get($primaryKey, $options = [])
 * @method \App\Model\Entity\OrganizationOfficer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OrganizationOfficer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrganizationOfficer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrganizationOfficer saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrganizationOfficer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OrganizationOfficer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrganizationOfficer findOrCreate($search, callable $callback = null, $options = [])
 */
class OrganizationOfficersTable extends Table
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

        $this->setTable('organization_officers');
        $this->setDisplayField('organization_officer_id');
        $this->setPrimaryKey('organization_officer_id');

        $this->belongsTo('Organizations', [
            'foreignKey' => 'organization_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('OrganizationOfficersPositions', [
            'foreignKey' => 'officers_position_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
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
            ->integer('organization_officer_id')
            ->allowEmptyString('organization_officer_id', 'create');

        $validator
            ->scalar('officer_lastname')
            ->maxLength('officer_lastname', 255)
            ->requirePresence('officer_lastname', 'create')
            ->allowEmptyString('officer_lastname', false);

        $validator
            ->scalar('officer_firstname')
            ->maxLength('officer_firstname', 255)
            ->requirePresence('officer_firstname', 'create')
            ->allowEmptyString('officer_firstname', false);

        $validator
            ->scalar('officer_middlename')
            ->maxLength('officer_middlename', 255)
            ->allowEmptyString('officer_middlename');

        $validator
            ->scalar('officer_photo')
            ->maxLength('officer_photo', 255)
            ->allowEmptyString('officer_photo');

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
        $rules->add($rules->existsIn(['organization_id'], 'Organizations'));
        $rules->add($rules->existsIn(['officers_position_id'], 'OrganizationOfficersPositions'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
