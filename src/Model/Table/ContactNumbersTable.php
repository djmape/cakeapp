<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ContactNumbers Model
 *
 * @method \App\Model\Entity\ContactNumber get($primaryKey, $options = [])
 * @method \App\Model\Entity\ContactNumber newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ContactNumber[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ContactNumber|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ContactNumber saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ContactNumber patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ContactNumber[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ContactNumber findOrCreate($search, callable $callback = null, $options = [])
 */
class ContactNumbersTable extends Table
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

        $this->setTable('contact_numbers');
        $this->setDisplayField('contact_number_id');
        $this->setPrimaryKey('contact_number_id');
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
            ->integer('contact_number_id')
            ->allowEmptyString('contact_number_id', 'create');

        $validator
            ->scalar('contact_number')
            ->maxLength('contact_number', 255)
            ->requirePresence('contact_number', 'create')
            ->allowEmptyString('contact_number', false);

        $validator
            ->integer('active')
            ->requirePresence('active', 'create')
            ->allowEmptyString('active', false);

        return $validator;
    }
}
