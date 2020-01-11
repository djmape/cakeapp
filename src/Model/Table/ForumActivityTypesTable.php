<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ForumActivityTypes Model
 *
 * @method \App\Model\Entity\ForumActivityType get($primaryKey, $options = [])
 * @method \App\Model\Entity\ForumActivityType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ForumActivityType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ForumActivityType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumActivityType saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumActivityType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ForumActivityType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ForumActivityType findOrCreate($search, callable $callback = null, $options = [])
 */
class ForumActivityTypesTable extends Table
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

        $this->setTable('forum_activity_types');
        $this->setDisplayField('forum_activity_type_id');
        $this->setPrimaryKey('forum_activity_type_id');
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
            ->integer('forum_activity_type_id')
            ->allowEmptyString('forum_activity_type_id', 'create');

        $validator
            ->scalar('forum_activity_type_name')
            ->maxLength('forum_activity_type_name', 255)
            ->requirePresence('forum_activity_type_name', 'create')
            ->allowEmptyString('forum_activity_type_name', false);

        return $validator;
    }
}
