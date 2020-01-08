<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserPostReactions Model
 *
 * @property \App\Model\Table\PostsTable|\Cake\ORM\Association\BelongsTo $Posts
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\UserPostActivitiesTable|\Cake\ORM\Association\BelongsTo $UserPostActivities
 * @property |\Cake\ORM\Association\BelongsTo $UserActivities
 *
 * @method \App\Model\Entity\UserPostReaction get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserPostReaction newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserPostReaction[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserPostReaction|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserPostReaction saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserPostReaction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserPostReaction[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserPostReaction findOrCreate($search, callable $callback = null, $options = [])
 */
class UserPostReactionsTable extends Table
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

        $this->setTable('user_post_reactions');
        $this->setDisplayField('user_post_reactions_id');
        $this->setPrimaryKey('user_post_reactions_id');

        $this->belongsTo('Posts', [
            'foreignKey' => 'user_post_reaction_post_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_post_reaction_user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('UserPostActivities', [
            'foreignKey' => 'user_post_reaction_post_activity_id'
        ]);
        $this->belongsTo('UserActivities', [
            'foreignKey' => 'user_post_reactions_activity_id'
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
            ->integer('user_post_reactions_id')
            ->allowEmptyString('user_post_reactions_id', 'create');

        $validator
            ->boolean('user_post_reaction_like')
            ->requirePresence('user_post_reaction_like', 'create')
            ->allowEmptyString('user_post_reaction_like', false);

        $validator
            ->boolean('user_post_reaction_dislike')
            ->requirePresence('user_post_reaction_dislike', 'create')
            ->allowEmptyString('user_post_reaction_dislike', false);

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
        $rules->add($rules->existsIn(['user_post_reaction_post_id'], 'Posts'));
        $rules->add($rules->existsIn(['user_post_reaction_user_id'], 'Users'));
        $rules->add($rules->existsIn(['user_post_reaction_post_activity_id'], 'UserPostActivities'));
        $rules->add($rules->existsIn(['user_post_reactions_activity_id'], 'UserActivities'));

        return $rules;
    }
}
