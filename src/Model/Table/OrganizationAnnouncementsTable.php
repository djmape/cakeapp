<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrganizationAnnouncements Model
 *
 * @property \App\Model\Table\PostsTable|\Cake\ORM\Association\BelongsTo $Posts
 * @property |\Cake\ORM\Association\BelongsTo $Organizations
 *
 * @method \App\Model\Entity\OrganizationAnnouncement get($primaryKey, $options = [])
 * @method \App\Model\Entity\OrganizationAnnouncement newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OrganizationAnnouncement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrganizationAnnouncement|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrganizationAnnouncement saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrganizationAnnouncement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OrganizationAnnouncement[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrganizationAnnouncement findOrCreate($search, callable $callback = null, $options = [])
 */
class OrganizationAnnouncementsTable extends Table
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

        $this->setTable('organization_announcements');
        $this->setDisplayField('organization_announcement_id');
        $this->setPrimaryKey('organization_announcement_id');

        $this->belongsTo('Posts', [
            'foreignKey' => 'announcement_post_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Organizations', [
            'foreignKey' => 'organization_id'
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
            ->integer('organization_announcement_id')
            ->allowEmptyString('organization_announcement_id', 'create');

        $validator
            ->scalar('organization_announcement_title')
            ->maxLength('organization_announcement_title', 255)
            ->requirePresence('organization_announcement_title', 'create')
            ->allowEmptyString('organization_announcement_title', false);

        $validator
            ->scalar('organization_announcement_body')
            ->maxLength('organization_announcement_body', 255)
            ->requirePresence('organization_announcement_body', 'create')
            ->allowEmptyString('organization_announcement_body', false);

        $validator
            ->dateTime('organization_announcement_created')
            ->allowEmptyDateTime('organization_announcement_created', false);

        $validator
            ->dateTime('organization_announcement_modified')
            ->allowEmptyDateTime('organization_announcement_modified', false);

        $validator
            ->integer('active')
            ->allowEmptyString('active', false);

        $validator
            ->boolean('organization_announcement_visibility_members_only')
            ->allowEmptyString('organization_announcement_visibility_members_only');

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
        $rules->add($rules->existsIn(['announcement_post_id'], 'Posts'));
        $rules->add($rules->existsIn(['organization_id'], 'Organizations'));

        return $rules;
    }
}
