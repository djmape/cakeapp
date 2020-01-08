<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ActivityTypes Model
 *
 * @method \App\Model\Entity\ActivityType get($primaryKey, $options = [])
 * @method \App\Model\Entity\ActivityType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ActivityType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ActivityType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ActivityType saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ActivityType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ActivityType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ActivityType findOrCreate($search, callable $callback = null, $options = [])
 */
class ActivityTypesTable extends Table
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

        $this->setTable('activity_types');
        $this->setDisplayField('activity_type_id');
        $this->setPrimaryKey('activity_type_id');
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
            ->integer('activity_type_id')
            ->allowEmptyString('activity_type_id', 'create');

        $validator
            ->scalar('activity_type_name')
            ->maxLength('activity_type_name', 200)
            ->requirePresence('activity_type_name', 'create')
            ->allowEmptyString('activity_type_name', false);

        return $validator;
    }
}
