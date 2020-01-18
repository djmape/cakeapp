<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserForumActivityCounts Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\UserForumActivityCount get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserForumActivityCount newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserForumActivityCount[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserForumActivityCount|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserForumActivityCount saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserForumActivityCount patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserForumActivityCount[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserForumActivityCount findOrCreate($search, callable $callback = null, $options = [])
 */
class UserForumActivityCountsTable extends Table
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

        $this->setTable('user_forum_activity_counts');
        $this->setDisplayField('user_forum_activity_count_id');
        $this->setPrimaryKey('user_forum_activity_count_id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->integer('user_forum_activity_count_id')
            ->allowEmptyString('user_forum_activity_count_id', 'create');

        $validator
            ->integer('user_forum_activity_categories_count')
            ->allowEmptyString('user_forum_activity_categories_count', false);

        $validator
            ->integer('user_forum_activity_topics_count')
            ->allowEmptyString('user_forum_activity_topics_count', false);

        $validator
            ->integer('user_forum_activity_discussions_count')
            ->allowEmptyString('user_forum_activity_discussions_count', false);

        $validator
            ->integer('user_forum_activity_replies_count')
            ->allowEmptyString('user_forum_activity_replies_count', false);

        $validator
            ->integer('user_forum_activity_reactions_count')
            ->allowEmptyString('user_forum_activity_reactions_count', false);

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
