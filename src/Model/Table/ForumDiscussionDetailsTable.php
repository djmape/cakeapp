<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ForumDiscussionDetails Model
 *
 * @property \App\Model\Table\ForumDiscussionsTable|\Cake\ORM\Association\BelongsTo $ForumDiscussions
 *
 * @method \App\Model\Entity\ForumDiscussionDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\ForumDiscussionDetail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ForumDiscussionDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ForumDiscussionDetail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumDiscussionDetail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumDiscussionDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ForumDiscussionDetail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ForumDiscussionDetail findOrCreate($search, callable $callback = null, $options = [])
 */
class ForumDiscussionDetailsTable extends Table
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

        $this->setTable('forum_discussion_details');
        $this->setDisplayField('forum_discussion_detail_id');
        $this->setPrimaryKey('forum_discussion_detail_id');

        $this->belongsTo('ForumDiscussions', [
            'foreignKey' => 'forum_discussion_detail_discussion_id',
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
            ->integer('forum_discussion_detail_id')
            ->allowEmptyString('forum_discussion_detail_id', 'create');

        $validator
            ->integer('forum_discussion_detail_replies_count')
            ->allowEmptyString('forum_discussion_detail_replies_count');

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
        $rules->add($rules->existsIn(['forum_discussion_detail_discussion_id'], 'ForumDiscussions'));

        return $rules;
    }
}
