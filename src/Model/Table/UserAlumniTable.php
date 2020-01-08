<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserAlumni Model
 *
 * @property \App\Model\Table\CoursesTable|\Cake\ORM\Association\BelongsTo $Courses
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\UserAlumnus get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserAlumnus newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserAlumnus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserAlumnus|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserAlumnus saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserAlumnus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserAlumnus[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserAlumnus findOrCreate($search, callable $callback = null, $options = [])
 */
class UserAlumniTable extends Table
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

        $this->setTable('user_alumni');
        $this->setDisplayField('user_alumni_id');
        $this->setPrimaryKey('user_alumni_id');

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
            ->integer('user_alumni_id')
            ->allowEmptyString('user_alumni_id', 'create');

        $validator
            ->scalar('user_alumni_lastname')
            ->maxLength('user_alumni_lastname', 200)
            ->requirePresence('user_alumni_lastname', 'create')
            ->allowEmptyString('user_alumni_lastname', false);

        $validator
            ->scalar('user_alumni_firstname')
            ->maxLength('user_alumni_firstname', 200)
            ->requirePresence('user_alumni_firstname', 'create')
            ->allowEmptyString('user_alumni_firstname', false);

        $validator
            ->scalar('user_alumni_middlename')
            ->maxLength('user_alumni_middlename', 200)
            ->allowEmptyString('user_alumni_middlename');

        $validator
            ->scalar('user_alumni_photo')
            ->maxLength('user_alumni_photo', 1000)
            ->requirePresence('user_alumni_photo', 'create')
            ->allowEmptyString('user_alumni_photo', false);

        $validator
            ->scalar('user_alumni_student_number')
            ->maxLength('user_alumni_student_number', 50)
            ->allowEmptyString('user_alumni_student_number');

        $validator
            ->integer('user_alumni_year_graduated')
            ->allowEmptyString('user_alumni_year_graduated');

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
