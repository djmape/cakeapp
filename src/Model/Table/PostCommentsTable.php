<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PostComments Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\PostsTable|\Cake\ORM\Association\BelongsTo $Posts
 * @property \App\Model\Table\UserPostActivitiesTable|\Cake\ORM\Association\BelongsTo $UserPostActivities
 * @property \App\Model\Table\UserPostActivitiesTable|\Cake\ORM\Association\BelongsTo $UserPostActivities
 *
 * @method \App\Model\Entity\PostComment get($primaryKey, $options = [])
 * @method \App\Model\Entity\PostComment newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PostComment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PostComment|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PostComment saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PostComment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PostComment[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PostComment findOrCreate($search, callable $callback = null, $options = [])
 */
class PostCommentsTable extends Table
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

        $this->setTable('post_comments');
        $this->setDisplayField('post_comment_id');
        $this->setPrimaryKey('post_comment_id');

        $this->belongsTo('Users', [
            'foreignKey' => 'post_comment_user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Posts', [
            'foreignKey' => 'post_comment_post_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('UserPostActivities', [
            'foreignKey' => 'post_comment_post_activity_id'
        ]);
        $this->belongsTo('UserPostActivities', [
            'foreignKey' => 'post_comment_activity_id'
        ]);
        $this->hasOne('PostCommentContents', [
            'foreignKey' => 'post_comment_content_post_comment_id'
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
            ->integer('post_comment_id')
            ->allowEmptyString('post_comment_id', 'create');

        $validator
            ->dateTime('post_comment_timestamp')
            ->allowEmptyDateTime('post_comment_timestamp', false);

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
        $rules->add($rules->existsIn(['post_comment_user_id'], 'Users'));
        $rules->add($rules->existsIn(['post_comment_post_id'], 'Posts'));
        $rules->add($rules->existsIn(['post_comment_post_activity_id'], 'UserPostActivities'));
        $rules->add($rules->existsIn(['post_comment_activity_id'], 'UserPostActivities'));

        return $rules;
    }
}
