<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Courses Model
 *
 * @property \App\Model\Table\OrganizationsTable|\Cake\ORM\Association\BelongsTo $Organizations
 *
 * @method \App\Model\Entity\Course get($primaryKey, $options = [])
 * @method \App\Model\Entity\Course newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Course[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Course|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Course saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Course patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Course[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Course findOrCreate($search, callable $callback = null, $options = [])
 */
class CoursesTable extends Table
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

        $this->setTable('courses');
        $this->setDisplayField('course_id');
        $this->setPrimaryKey('course_id');

        $this->belongsTo('Organizations', [
            'foreignKey' => 'organization_id',
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
            ->integer('course_id')
            ->allowEmptyString('course_id', 'create');

        $validator
            ->scalar('course_name')
            ->maxLength('course_name', 2550)
            ->requirePresence('course_name', 'create')
            ->allowEmptyString('course_name', false);

        $validator
            ->scalar('course_acronym')
            ->maxLength('course_acronym', 2550)
            ->requirePresence('course_acronym', 'create')
            ->allowEmptyString('course_acronym', false);

        $validator
            ->scalar('course_mission')
            ->maxLength('course_mission', 2550)
            ->allowEmptyString('course_mission');

        $validator
            ->scalar('course_vision')
            ->maxLength('course_vision', 2550)
            ->allowEmptyString('course_vision');

        $validator
            ->scalar('course_goal')
            ->maxLength('course_goal', 2550)
            ->allowEmptyString('course_goal');

        $validator
            ->scalar('course_objective')
            ->maxLength('course_objective', 2550)
            ->allowEmptyString('course_objective');

        $validator
            ->scalar('course_type')
            ->maxLength('course_type', 2550)
            ->requirePresence('course_type', 'create')
            ->allowEmptyString('course_type', false);

        $validator
            ->integer('active')
            ->requirePresence('active', 'create')
            ->allowEmptyString('active', false);

        $validator
            ->scalar('other_info')
            ->allowEmptyString('other_info');

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
        $rules->add($rules->existsIn(['organization_id'], 'Organizations'));

        return $rules;
    }
}
