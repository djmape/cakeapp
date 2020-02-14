<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserNotifications Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\UserNotification get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserNotification newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserNotification[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserNotification|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserNotification saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserNotification patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserNotification[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserNotification findOrCreate($search, callable $callback = null, $options = [])
 */
class UserNotificationsTable extends Table
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

        $this->setTable('user_notifications');
        $this->setDisplayField('user_notification_id');
        $this->setPrimaryKey('user_notification_id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_notification_receiver_user_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('ForumNotifications', [
            'foreignKey' => 'user_notification_id'
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
            ->integer('user_notification_id')
            ->allowEmptyString('user_notification_id', 'create');

        $validator
            ->dateTime('user_notification_created')
            ->allowEmptyDateTime('user_notification_created', false);

        $validator
            ->boolean('user_notification_read_status')
            ->allowEmptyString('user_notification_read_status', false);

        $validator
            ->dateTime('user_notification_date_read')
            ->allowEmptyDateTime('user_notification_date_read', false);

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
        $rules->add($rules->existsIn(['user_notification_receiver_user_id'], 'Users'));

        return $rules;
    }
}
