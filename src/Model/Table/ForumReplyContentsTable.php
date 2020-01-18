<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ForumReplyContents Model
 *
 * @property \App\Model\Table\ForumReplyContentForumRepliesTable|\Cake\ORM\Association\BelongsTo $ForumReplyContentForumReplies
 *
 * @method \App\Model\Entity\ForumReplyContent get($primaryKey, $options = [])
 * @method \App\Model\Entity\ForumReplyContent newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ForumReplyContent[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ForumReplyContent|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumReplyContent saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumReplyContent patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ForumReplyContent[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ForumReplyContent findOrCreate($search, callable $callback = null, $options = [])
 */
class ForumReplyContentsTable extends Table
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

        $this->setTable('forum_reply_contents');
        $this->setDisplayField('forum_reply_content_d');
        $this->setPrimaryKey('forum_reply_content_d');

        $this->belongsTo('ForumReplyContentForumReplies', [
            'foreignKey' => 'forum_reply_content_forum_reply_id',
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
            ->integer('forum_reply_content_d')
            ->allowEmptyString('forum_reply_content_d', 'create');

        $validator
            ->scalar('forum_reply_content')
            ->requirePresence('forum_reply_content', 'create')
            ->allowEmptyString('forum_reply_content', false);

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
        $rules->add($rules->existsIn(['forum_reply_content_forum_reply_id'], 'ForumReplyContentForumReplies'));

        return $rules;
    }
}
