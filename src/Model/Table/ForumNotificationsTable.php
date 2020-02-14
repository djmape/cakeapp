<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ForumNotifications Model
 *
 * @property \App\Model\Table\UserNotificationsTable|\Cake\ORM\Association\BelongsTo $UserNotifications
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ForumNotificationTypesTable|\Cake\ORM\Association\BelongsTo $ForumNotificationTypes
 * @property \App\Model\Table\ForumDiscussionsTable|\Cake\ORM\Association\BelongsTo $ForumDiscussions
 * @property \App\Model\Table\ForumRepliesTable|\Cake\ORM\Association\BelongsTo $ForumReplies
 *
 * @method \App\Model\Entity\ForumNotification get($primaryKey, $options = [])
 * @method \App\Model\Entity\ForumNotification newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ForumNotification[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ForumNotification|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumNotification saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ForumNotification patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ForumNotification[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ForumNotification findOrCreate($search, callable $callback = null, $options = [])
 */
class ForumNotificationsTable extends Table
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

        $this->setTable('forum_notifications');
        $this->setDisplayField('forum_notification_id');
        $this->setPrimaryKey('forum_notification_id');

        $this->belongsTo('UserNotifications', [
            'foreignKey' => 'user_notification_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'forum_notification_sender_user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ForumNotificationTypes', [
            'foreignKey' => 'forum_notification_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ForumDiscussions', [
            'foreignKey' => 'forum_notification_discussion_id'
        ]);
        $this->belongsTo('ForumReplies', [
            'foreignKey' => 'forum_notification_reply_id'
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
            ->integer('forum_notification_id')
            ->allowEmptyString('forum_notification_id', 'create');

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
        $rules->add($rules->existsIn(['user_notification_id'], 'UserNotifications'));
        $rules->add($rules->existsIn(['forum_notification_sender_user_id'], 'Users'));
        $rules->add($rules->existsIn(['forum_notification_type_id'], 'ForumNotificationTypes'));
        $rules->add($rules->existsIn(['forum_notification_discussion_id'], 'ForumDiscussions'));
        $rules->add($rules->existsIn(['forum_notification_reply_id'], 'ForumReplies'));

        return $rules;
    }
}
