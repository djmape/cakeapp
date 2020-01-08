<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PostCommentContents Model
 *
 * @property \App\Model\Table\PostCommentsTable|\Cake\ORM\Association\BelongsTo $PostComments
 *
 * @method \App\Model\Entity\PostCommentContent get($primaryKey, $options = [])
 * @method \App\Model\Entity\PostCommentContent newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PostCommentContent[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PostCommentContent|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PostCommentContent saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PostCommentContent patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PostCommentContent[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PostCommentContent findOrCreate($search, callable $callback = null, $options = [])
 */
class PostCommentContentsTable extends Table
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

        $this->setTable('post_comment_contents');
        $this->setDisplayField('post_comment_content_id');
        $this->setPrimaryKey('post_comment_content_id');

        $this->belongsTo('PostComments', [
            'foreignKey' => 'post_comment_content_post_comment_id',
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
            ->integer('post_comment_content_id')
            ->allowEmptyString('post_comment_content_id', 'create');

        $validator
            ->scalar('post_comment_content')
            ->requirePresence('post_comment_content', 'create')
            ->allowEmptyString('post_comment_content', false);

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
        $rules->add($rules->existsIn(['post_comment_content_post_comment_id'], 'PostComments'));

        return $rules;
    }
}
