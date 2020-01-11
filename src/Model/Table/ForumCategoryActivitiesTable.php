<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ForumCategoryActivities Model
 *
 * @property \App\Model\Table\ForumActivitiesTable|\Cake\ORM\Association\BelongsTo $ForumActivities
 * @property \App\Model\Table\ForumCategoriesTable|\Cake\ORM\Association\BelongsTo $ForumCategories
 *
 * @method \App\Model\Entity\ForumCategoryActivity get($primaryKey, $options = [])
 * @method \App\Model\Entity\ForumCategoryActivity newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ForumCategoryActivity[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ForumCategoryActivity|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumCategoryActivity saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumCategoryActivity patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ForumCategoryActivity[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ForumCategoryActivity findOrCreate($search, callable $callback = null, $options = [])
 */
class ForumCategoryActivitiesTable extends Table
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

        $this->setTable('forum_category_activities');
        $this->setDisplayField('forum_category_activity_id');
        $this->setPrimaryKey('forum_category_activity_id');

        $this->belongsTo('ForumActivities', [
            'foreignKey' => 'forum_category_activity_forum_activity_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ForumCategories', [
            'foreignKey' => 'forum_category_activity_forum_category_id',
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
            ->integer('forum_category_activity_id')
            ->allowEmptyString('forum_category_activity_id', 'create');

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
        $rules->add($rules->existsIn(['forum_category_activity_forum_activity_id'], 'ForumActivities'));
        $rules->add($rules->existsIn(['forum_category_activity_forum_category_id'], 'ForumCategories'));

        return $rules;
    }
}
