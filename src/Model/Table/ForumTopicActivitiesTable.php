<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ForumTopicActivities Model
 *
 * @property \App\Model\Table\ForumTopicActivityForumActivitiesTable|\Cake\ORM\Association\BelongsTo $ForumTopicActivityForumActivities
 * @property \App\Model\Table\ForumTopicActivityForumTopicsTable|\Cake\ORM\Association\BelongsTo $ForumTopicActivityForumTopics
 *
 * @method \App\Model\Entity\ForumTopicActivity get($primaryKey, $options = [])
 * @method \App\Model\Entity\ForumTopicActivity newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ForumTopicActivity[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ForumTopicActivity|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumTopicActivity saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumTopicActivity patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ForumTopicActivity[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ForumTopicActivity findOrCreate($search, callable $callback = null, $options = [])
 */
class ForumTopicActivitiesTable extends Table
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

        $this->setTable('forum_topic_activities');
        $this->setDisplayField('forum_topic_activity_id');
        $this->setPrimaryKey('forum_topic_activity_id');

        $this->belongsTo('ForumActivities', [
            'foreignKey' => 'forum_topic_activity_forum_activity_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ForumTopics', [
            'foreignKey' => 'forum_topic_activity_forum_topic_id',
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
            ->integer('forum_topic_activity_id')
            ->allowEmptyString('forum_topic_activity_id', 'create');

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
        $rules->add($rules->existsIn(['forum_topic_activity_forum_activity_id'], 'ForumActivities'));
        $rules->add($rules->existsIn(['forum_topic_activity_forum_topic_id'], 'ForumTopics'));

        return $rules;
    }
}
