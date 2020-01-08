<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserPostActivityTypes Model
 *
 * @method \App\Model\Entity\UserPostActivityType get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserPostActivityType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserPostActivityType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserPostActivityType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserPostActivityType saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserPostActivityType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserPostActivityType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserPostActivityType findOrCreate($search, callable $callback = null, $options = [])
 */
class UserPostActivityTypesTable extends Table
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

        $this->setTable('user_post_activity_types');
        $this->setDisplayField('user_post_activity_type_id');
        $this->setPrimaryKey('user_post_activity_type_id');
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
            ->integer('user_post_activity_type_id')
            ->allowEmptyString('user_post_activity_type_id', 'create');

        $validator
            ->scalar('user_post_activity_type_name')
            ->maxLength('user_post_activity_type_name', 200)
            ->requirePresence('user_post_activity_type_name', 'create')
            ->allowEmptyString('user_post_activity_type_name', false);

        return $validator;
    }
}
