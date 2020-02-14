<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ForumDiscussions Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $ForumDiscussionCreatedByUsers
 * @property |\Cake\ORM\Association\BelongsTo $ForumTopics
 *
 * @method \App\Model\Entity\ForumDiscussion get($primaryKey, $options = [])
 * @method \App\Model\Entity\ForumDiscussion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ForumDiscussion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ForumDiscussion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumDiscussion saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumDiscussion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ForumDiscussion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ForumDiscussion findOrCreate($search, callable $callback = null, $options = [])
 */
class ForumDiscussionsTable extends Table
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

        $this->setTable('forum_discussions');
        $this->setDisplayField('forum_discussion_id');
        $this->setPrimaryKey('forum_discussion_id');

        $this->belongsTo('Users', [
            'foreignKey' => 'forum_discussion_created_by_user_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('ForumTopics', [
            'foreignKey' => 'forum_discussion_topic_id',
            'joinType' => 'INNER'
        ]);

        $this->hasOne('ForumDiscussionDetails', [
            'foreignKey' => 'forum_discussion_detail_discussion_id'
        ]);
        
        $this->hasMany('ForumNotifications', [
            'foreignKey' => 'forum_notification_discussion_id'
        ]);
        
        $this->hasMany('UserForumDiscussionVotes', [
            'foreignKey' => 'forum_discussion_id'
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
            ->integer('forum_discussion_id')
            ->allowEmptyString('forum_discussion_id', 'create');

        $validator
            ->scalar('forum_discussion_title')
            ->maxLength('forum_discussion_title', 255)
            ->requirePresence('forum_discussion_title', 'create')
            ->allowEmptyString('forum_discussion_title', false);

        $validator
            ->dateTime('forum_discussion_created')
            ->allowEmptyDateTime('forum_discussion_created', false);

        $validator
            ->dateTime('forum_discussion_updated')
            ->allowEmptyDateTime('forum_discussion_updated', false);

        $validator
            ->integer('forum_discussion_active')
            ->allowEmptyString('forum_discussion_active', false);

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
        $rules->add($rules->existsIn(['forum_discussion_created_by_user_id'], 'Users'));
        $rules->add($rules->existsIn(['forum_discussion_topic_id'], 'ForumTopics'));

        return $rules;
    }
}
