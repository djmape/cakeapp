<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ForumReplyDetails Model
 *
 * @property \App\Model\Table\ForumRepliesTable|\Cake\ORM\Association\BelongsTo $ForumReplies
 *
 * @method \App\Model\Entity\ForumReplyDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\ForumReplyDetail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ForumReplyDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ForumReplyDetail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumReplyDetail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumReplyDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ForumReplyDetail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ForumReplyDetail findOrCreate($search, callable $callback = null, $options = [])
 */
class ForumReplyDetailsTable extends Table
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

        $this->setTable('forum_reply_details');
        $this->setDisplayField('forum_reply_detail_id');
        $this->setPrimaryKey('forum_reply_detail_id');

        $this->belongsTo('ForumReplies', [
            'foreignKey' => 'forum_reply_detail_forum_reply_id',
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
            ->integer('forum_reply_detail_id')
            ->allowEmptyString('forum_reply_detail_id', 'create');

        $validator
            ->integer('forum_reply_detail_likes_count')
            ->allowEmptyString('forum_reply_detail_likes_count', false);

        $validator
            ->integer('forum_reply_detail_dislikes_count')
            ->allowEmptyString('forum_reply_detail_dislikes_count', false);

        $validator
            ->scalar('forum_reply_detail_content')
            ->requirePresence('forum_reply_detail_content', 'create')
            ->allowEmptyString('forum_reply_detail_content', false);

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
        $rules->add($rules->existsIn(['forum_reply_detail_forum_reply_id'], 'ForumReplies'));

        return $rules;
    }
}
