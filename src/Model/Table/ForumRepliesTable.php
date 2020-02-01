<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ForumReplies Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $ForumReplyCreatedByUsers
 * @property \App\Model\Table\ForumDiscussionsTable|\Cake\ORM\Association\BelongsTo $ForumDiscussions
 * @property |\Cake\ORM\Association\BelongsTo $ForumReplies
 *
 * @method \App\Model\Entity\ForumReply get($primaryKey, $options = [])
 * @method \App\Model\Entity\ForumReply newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ForumReply[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ForumReply|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumReply saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumReply patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ForumReply[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ForumReply findOrCreate($search, callable $callback = null, $options = [])
 */
class ForumRepliesTable extends Table
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

        $this->setTable('forum_replies');
        $this->setDisplayField('forum_reply_id');
        $this->setPrimaryKey('forum_reply_id');

        $this->belongsTo('Users', [
            'foreignKey' => 'forum_reply_created_by_user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ForumDiscussions', [
            'foreignKey' => 'forum_discussion_id',
            'joinType' => 'INNER'
        ]);
        
        $this->hasOne('ForumReplyActivities', [
            'foreignKey' => 'forum_reply_activity_forum_reply_id'
        ]);
        
        $this->hasOne('ForumReplyDetails', [
            'foreignKey' => 'forum_reply_detail_forum_reply_id'
        ]);
        
        $this->hasMany('ForumChildReplies', [
            'className' => 'ForumReplies',
            'foreignKey' => 'forum_parent_reply_id'
        ]);
        
        $this->belongsTo('ForumParentReplies', [
            'className' => 'ForumReplies',
            'foreignKey' => 'forum_parent_reply_id',
            'joinType' => 'LEFT'
        ]);
        
        $this->hasMany('UserForumReplyVotes', [
            'foreignKey' => 'forum_reply_id'
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
            ->integer('forum_reply_id')
            ->allowEmptyString('forum_reply_id', 'create');

        $validator
            ->dateTime('forum_reply_created')
            ->allowEmptyDateTime('forum_reply_created', false);

        $validator
            ->dateTime('forum_reply_updated')
            ->allowEmptyDateTime('forum_reply_updated', false);

        $validator
            ->integer('forum_reply_active')
            ->allowEmptyString('forum_reply_active', false);

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
        $rules->add($rules->existsIn(['forum_reply_created_by_user_id'], 'Users'));
        $rules->add($rules->existsIn(['forum_discussion_id'], 'ForumDiscussions'));

        return $rules;
    }
}
