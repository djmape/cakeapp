<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ForumNotificationTypes Model
 *
 * @method \App\Model\Entity\ForumNotificationType get($primaryKey, $options = [])
 * @method \App\Model\Entity\ForumNotificationType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ForumNotificationType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ForumNotificationType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumNotificationType saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumNotificationType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ForumNotificationType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ForumNotificationType findOrCreate($search, callable $callback = null, $options = [])
 */
class ForumNotificationTypesTable extends Table
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

        $this->setTable('forum_notification_types');
        $this->setDisplayField('forum_notification_type_id');
        $this->setPrimaryKey('forum_notification_type_id');

        $this->hasMany('ForumNotifications', [
            'foreignKey' => 'forum_notification_type_id'
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
            ->integer('forum_notification_type_id')
            ->allowEmptyString('forum_notification_type_id', 'create');

        $validator
            ->scalar('forum_notification_type_name')
            ->maxLength('forum_notification_type_name', 255)
            ->requirePresence('forum_notification_type_name', 'create')
            ->allowEmptyString('forum_notification_type_name', false);

        return $validator;
    }
}
