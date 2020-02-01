<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ForumReplyHistory Model
 *
 * @property \App\Model\Table\ForumRepliesTable|\Cake\ORM\Association\BelongsTo $ForumReplies
 *
 * @method \App\Model\Entity\ForumReplyHistory get($primaryKey, $options = [])
 * @method \App\Model\Entity\ForumReplyHistory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ForumReplyHistory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ForumReplyHistory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumReplyHistory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumReplyHistory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ForumReplyHistory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ForumReplyHistory findOrCreate($search, callable $callback = null, $options = [])
 */
class ForumReplyHistoryTable extends Table
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

        $this->setTable('forum_reply_history');
        $this->setDisplayField('forum_reply_history_id');
        $this->setPrimaryKey('forum_reply_history_id');

        $this->belongsTo('ForumReplies', [
            'foreignKey' => 'forum_reply_id',
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
            ->integer('forum_reply_history_id')
            ->allowEmptyString('forum_reply_history_id', 'create');

        $validator
            ->scalar('forum_reply_history_reply_content')
            ->allowEmptyString('forum_reply_history_reply_content');

        $validator
            ->dateTime('forum_reply_history_reply_timestamp_updated')
            ->allowEmptyDateTime('forum_reply_history_reply_timestamp_updated', false);

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

        return $rules;
    }
}
