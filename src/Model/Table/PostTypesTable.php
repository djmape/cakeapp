<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PostTypes Model
 *
 * @method \App\Model\Entity\PostType get($primaryKey, $options = [])
 * @method \App\Model\Entity\PostType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PostType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PostType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PostType saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PostType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PostType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PostType findOrCreate($search, callable $callback = null, $options = [])
 */
class PostTypesTable extends Table
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

        $this->setTable('post_types');
        $this->setDisplayField('post_type_id');
        $this->setPrimaryKey('post_type_id');
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
            ->integer('post_type_id')
            ->allowEmptyString('post_type_id', 'create');

        $validator
            ->scalar('post_type_name')
            ->maxLength('post_type_name', 200)
            ->requirePresence('post_type_name', 'create')
            ->allowEmptyString('post_type_name', false);

        return $validator;
    }
}
