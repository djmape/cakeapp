<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserForumReplyVotes Model
 *
 * @property \App\Model\Table\ForumRepliesTable|\Cake\ORM\Association\BelongsTo $ForumReplies
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\UserForumReplyVote get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserForumReplyVote newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserForumReplyVote[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserForumReplyVote|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserForumReplyVote saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserForumReplyVote patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserForumReplyVote[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserForumReplyVote findOrCreate($search, callable $callback = null, $options = [])
 */
class UserForumReplyVotesTable extends Table
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

        $this->setTable('user_forum_reply_votes');
        $this->setDisplayField('forum_reply_vote_id');
        $this->setPrimaryKey('forum_reply_vote_id');

        $this->belongsTo('ForumReplies', [
            'foreignKey' => 'forum_reply_id',
            'joinType' => 'INNER'
        ]);
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
            ->integer('forum_reply_vote_id')
            ->allowEmptyString('forum_reply_vote_id', 'create');

        $validator
            ->boolean('forum_reply_vote_upvote')
            ->allowEmptyString('forum_reply_vote_upvote', false);

        $validator
            ->boolean('forum_reply_vote_downvote')
            ->allowEmptyString('forum_reply_vote_downvote', false);

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
        $rules->add($rules->existsIn(['forum_reply_id'], 'ForumReplies'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
