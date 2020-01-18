<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ForumReplyActivities Model
 *
 * @property \App\Model\Table\ForumReplyActivityForumActivitiesTable|\Cake\ORM\Association\BelongsTo $ForumReplyActivityForumActivities
 * @property \App\Model\Table\ForumReplyActivityForumRepliesTable|\Cake\ORM\Association\BelongsTo $ForumReplyActivityForumReplies
 *
 * @method \App\Model\Entity\ForumReplyActivity get($primaryKey, $options = [])
 * @method \App\Model\Entity\ForumReplyActivity newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ForumReplyActivity[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ForumReplyActivity|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumReplyActivity saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumReplyActivity patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ForumReplyActivity[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ForumReplyActivity findOrCreate($search, callable $callback = null, $options = [])
 */
class ForumReplyActivitiesTable extends Table
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

        $this->setTable('forum_reply_activities');
        $this->setDisplayField('forum_reply_activity_id');
        $this->setPrimaryKey('forum_reply_activity_id');

        $this->belongsTo('ForumActivities', [
            'foreignKey' => 'forum_reply_activity_forum_activity_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ForumReplies', [
            'foreignKey' => 'forum_reply_activity_forum_reply_id',
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
            ->integer('forum_reply_activity_id')
            ->allowEmptyString('forum_reply_activity_id', 'create');

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
        $rules->add($rules->existsIn(['forum_reply_activity_forum_activity_id'], 'ForumActivities'));
        $rules->add($rules->existsIn(['forum_reply_activity_forum_reply_id'], 'ForumReplies'));

        return $rules;
    }
}
