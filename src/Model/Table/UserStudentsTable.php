<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserStudents Model
 *
 * @property \App\Model\Table\CoursesTable|\Cake\ORM\Association\BelongsTo $Courses
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\UserStudent get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserStudent newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserStudent[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserStudent|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserStudent saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserStudent patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserStudent[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserStudent findOrCreate($search, callable $callback = null, $options = [])
 */
class UserStudentsTable extends Table
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

        $this->setTable('user_students');
        $this->setDisplayField('user_student_id');
        $this->setPrimaryKey('user_student_id');

        $this->belongsTo('Courses', [
            'foreignKey' => 'course_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->integer('user_student_id')
            ->allowEmptyString('user_student_id', 'create');

        $validator
            ->scalar('user_student_lastname')
            ->maxLength('user_student_lastname', 200)
            ->requirePresence('user_student_lastname', 'create')
            ->allowEmptyString('user_student_lastname', false);

        $validator
            ->scalar('user_student_firstname')
            ->maxLength('user_student_firstname', 200)
            ->requirePresence('user_student_firstname', 'create')
            ->allowEmptyString('user_student_firstname', false);

        $validator
            ->scalar('user_student_middlename')
            ->maxLength('user_student_middlename', 200)
            ->allowEmptyString('user_student_middlename');

        $validator
            ->scalar('user_student_photo')
            ->maxLength('user_student_photo', 1000)
            ->requirePresence('user_student_photo', 'create')
            ->allowEmptyString('user_student_photo', false);

        $validator
            ->scalar('user_student_number')
            ->maxLength('user_student_number', 50)
            ->allowEmptyString('user_student_number');

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
        $rules->add($rules->existsIn(['course_id'], 'Courses'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
