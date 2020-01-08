<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserProfiles Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\UserProfile get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserProfile newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserProfile[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserProfile|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserProfile saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserProfile patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserProfile[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserProfile findOrCreate($search, callable $callback = null, $options = [])
 */
class UserProfilesTable extends Table
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

        $this->setTable('user_profiles');
        $this->setDisplayField('user_profile_id');
        $this->setPrimaryKey('user_profile_id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_profile_user_id',
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
            ->integer('user_profile_id')
            ->allowEmptyFile('user_profile_id', 'create');

        $validator
            ->scalar('user_profile_photo')
            ->maxLength('user_profile_photo', 1000)
            ->requirePresence('user_profile_photo', 'create')
            ->allowEmptyFile('user_profile_photo', false);

        $validator
            ->scalar('user_cover_photo')
            ->maxLength('user_cover_photo', 1000)
            ->requirePresence('user_cover_photo', 'create')
            ->allowEmptyString('user_cover_photo', false);

        $validator
            ->scalar('user_profile_background')
            ->maxLength('user_profile_background', 1000)
            ->requirePresence('user_profile_background', 'create')
            ->allowEmptyFile('user_profile_background', false);

        $validator
            ->scalar('user_profile_bio')
            ->maxLength('user_profile_bio', 255)
            ->allowEmptyFile('user_profile_bio');

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
        $rules->add($rules->existsIn(['user_profile_user_id'], 'Users'));

        return $rules;
    }
}
