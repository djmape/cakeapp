<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PostReactions Model
 *
 * @property \App\Model\Table\PostsTable|\Cake\ORM\Association\BelongsTo $Posts
 *
 * @method \App\Model\Entity\PostReaction get($primaryKey, $options = [])
 * @method \App\Model\Entity\PostReaction newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PostReaction[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PostReaction|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PostReaction saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PostReaction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PostReaction[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PostReaction findOrCreate($search, callable $callback = null, $options = [])
 */
class PostReactionsTable extends Table
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

        $this->setTable('post_reactions');
        $this->setDisplayField('post_reactions_id');
        $this->setPrimaryKey('post_reactions_id');

        $this->belongsTo('Posts', [
            'foreignKey' => 'post_reactions_post_id',
            'joinType' => 'INNER'
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
            ->integer('post_reactions_id')
            ->allowEmptyString('post_reactions_id', 'create');

        $validator
            ->integer('post_comments_count')
            ->requirePresence('post_comments_count', 'create')
            ->allowEmptyString('post_comments_count', false);

        $validator
            ->integer('post_likes_count')
            ->requirePresence('post_likes_count', 'create')
            ->allowEmptyString('post_likes_count', false);

        $validator
            ->integer('post_dislikes_count')
            ->requirePresence('post_dislikes_count', 'create')
            ->allowEmptyString('post_dislikes_count', false);

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
        $rules->add($rules->existsIn(['post_reactions_post_id'], 'Posts'));

        return $rules;
    }
}
