<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ForumCategories Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\ForumCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\ForumCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ForumCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ForumCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumCategory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ForumCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ForumCategory findOrCreate($search, callable $callback = null, $options = [])
 */
class ForumCategoriesTable extends Table
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

        $this->setTable('forum_categories');
        $this->setDisplayField('forum_category_id');
        $this->setPrimaryKey('forum_category_id');

        $this->belongsTo('Users', [
            'foreignKey' => 'forum_category_created_by_user_id',
            'joinType' => 'INNER'
        ]);

        $this->hasOne('ForumCategoryDetails', [
            'foreignKey' => 'forum_category_detail_category_id'
        ]);

        $this->hasMany('ForumTopics', [
            'foreignKey' => 'forum_topic_category_id'
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
            ->integer('forum_category_id')
            ->allowEmptyString('forum_category_id', 'create');

        $validator
            ->scalar('forum_category_name')
            ->maxLength('forum_category_name', 255)
            ->requirePresence('forum_category_name', 'create')
            ->allowEmptyString('forum_category_name', false);

        $validator
            ->dateTime('forum_category_created')
            ->allowEmptyDateTime('forum_category_created', false);

        $validator
            ->dateTime('forum_category_modified')
            ->allowEmptyDateTime('forum_category_modified', false);

        $validator
            ->integer('forum_category_active')
            ->allowEmptyString('forum_category_active', false);

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
        $rules->add($rules->existsIn(['forum_category_created_by_user_id'], 'Users'));

        return $rules;
    }
}
