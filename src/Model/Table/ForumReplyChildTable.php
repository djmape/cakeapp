<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ForumReplyChild Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $ForumReplies
 * @property |\Cake\ORM\Association\BelongsTo $ForumReplies
 *
 * @method \App\Model\Entity\ForumReplyChild get($primaryKey, $options = [])
 * @method \App\Model\Entity\ForumReplyChild newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ForumReplyChild[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ForumReplyChild|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumReplyChild saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumReplyChild patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ForumReplyChild[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ForumReplyChild findOrCreate($search, callable $callback = null, $options = [])
 */
class ForumReplyChildTable extends Table
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

        $this->setTable('forum_reply_child');
        $this->setDisplayField('forum_reply_child_id');
        $this->setPrimaryKey('forum_reply_child_id');

        $this->belongsTo('ForumChildReplies', [
            'className' => 'ForumReplies',
            'foreignKey' => 'forum_reply_child_reply_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ForumParentReplies', [
            'className' => 'ForumReplies',
            'foreignKey' => 'forum_reply_parent_reply_id',
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
            ->integer('forum_reply_child_id')
            ->allowEmptyString('forum_reply_child_id', 'create');

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
        $rules->add($rules->existsIn(['forum_reply_child_reply_id'], 'ForumChildReplies'));
        $rules->add($rules->existsIn(['forum_reply_parent_reply_id'], 'ForumParentReplies'));

        return $rules;
    }
}
