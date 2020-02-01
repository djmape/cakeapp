<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ForumDiscussionVotes Model
 *
 * @property \App\Model\Table\ForumDiscussionsTable|\Cake\ORM\Association\BelongsTo $ForumDiscussions
 *
 * @method \App\Model\Entity\ForumDiscussionVote get($primaryKey, $options = [])
 * @method \App\Model\Entity\ForumDiscussionVote newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ForumDiscussionVote[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ForumDiscussionVote|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumDiscussionVote saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumDiscussionVote patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ForumDiscussionVote[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ForumDiscussionVote findOrCreate($search, callable $callback = null, $options = [])
 */
class ForumDiscussionVotesTable extends Table
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

        $this->setTable('forum_discussion_votes');
        $this->setDisplayField('forum_discussion_vote_id');
        $this->setPrimaryKey('forum_discussion_vote_id');

        $this->belongsTo('ForumDiscussions', [
            'foreignKey' => 'forum_discussion_id',
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
            ->integer('forum_discussion_vote_id')
            ->allowEmptyString('forum_discussion_vote_id', 'create');

        $validator
            ->integer('forum_discussion_vote_upvote_count')
            ->allowEmptyString('forum_discussion_vote_upvote_count', false);

        $validator
            ->integer('forum_discussion_vote_downvote_count')
            ->allowEmptyString('forum_discussion_vote_downvote_count', false);

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
        $rules->add($rules->existsIn(['forum_discussion_id'], 'ForumDiscussions'));

        return $rules;
    }
}
