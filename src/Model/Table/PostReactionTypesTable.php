<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PostReactionTypes Model
 *
 * @method \App\Model\Entity\PostReactionType get($primaryKey, $options = [])
 * @method \App\Model\Entity\PostReactionType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PostReactionType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PostReactionType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PostReactionType saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PostReactionType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PostReactionType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PostReactionType findOrCreate($search, callable $callback = null, $options = [])
 */
class PostReactionTypesTable extends Table
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

        $this->setTable('post_reaction_types');
        $this->setDisplayField('post_reaction_type_id');
        $this->setPrimaryKey('post_reaction_type_id');
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
            ->integer('post_reaction_type_id')
            ->allowEmptyString('post_reaction_type_id', 'create');

        $validator
            ->scalar('post_reaction_type_name')
            ->maxLength('post_reaction_type_name', 200)
            ->requirePresence('post_reaction_type_name', 'create')
            ->allowEmptyString('post_reaction_type_name', false);

        return $validator;
    }
}
