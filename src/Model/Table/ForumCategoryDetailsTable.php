<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ForumCategoryDetails Model
 *
 * @property \App\Model\Table\ForumCategoriesTable|\Cake\ORM\Association\BelongsTo $ForumCategories
 *
 * @method \App\Model\Entity\ForumCategoryDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\ForumCategoryDetail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ForumCategoryDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ForumCategoryDetail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumCategoryDetail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumCategoryDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ForumCategoryDetail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ForumCategoryDetail findOrCreate($search, callable $callback = null, $options = [])
 */
class ForumCategoryDetailsTable extends Table
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

        $this->setTable('forum_category_details');
        $this->setDisplayField('forum_category_detail_id');
        $this->setPrimaryKey('forum_category_detail_id');

        $this->belongsTo('ForumCategories', [
            'foreignKey' => 'forum_category_detail_category_id',
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
            ->integer('forum_category_detail_id')
            ->allowEmptyString('forum_category_detail_id', 'create');

        $validator
            ->integer('forum_category_topics_count')
            ->allowEmptyString('forum_category_topics_count', false);

        $validator
            ->integer('forum_category_discussions_count')
            ->allowEmptyString('forum_category_discussions_count', false);

        $validator
            ->integer('forum_category_replies_count')
            ->allowEmptyString('forum_category_replies_count', false);

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
        $rules->add($rules->existsIn(['forum_category_detail_category_id'], 'ForumCategories'));

        return $rules;
    }
}
