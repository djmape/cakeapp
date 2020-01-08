<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserActivityTypes Model
 *
 * @method \App\Model\Entity\UserActivityType get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserActivityType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserActivityType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserActivityType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserActivityType saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserActivityType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserActivityType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserActivityType findOrCreate($search, callable $callback = null, $options = [])
 */
class UserActivityTypesTable extends Table
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

        $this->setTable('user_activity_types');
        $this->setDisplayField('user_activity_type_id');
        $this->setPrimaryKey('user_activity_type_id');
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
            ->integer('user_activity_type_id')
            ->allowEmptyString('user_activity_type_id', 'create');

        $validator
            ->scalar('user_activity_type_name')
            ->maxLength('user_activity_type_name', 200)
            ->requirePresence('user_activity_type_name', 'create')
            ->allowEmptyString('user_activity_type_name', false);

        return $validator;
    }
}
