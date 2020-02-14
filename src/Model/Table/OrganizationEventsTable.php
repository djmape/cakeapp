<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrganizationEvents Model
 *
 * @property \App\Model\Table\OrganizationsTable|\Cake\ORM\Association\BelongsTo $Organizations
 * @property \App\Model\Table\PostsTable|\Cake\ORM\Association\BelongsTo $Posts
 *
 * @method \App\Model\Entity\OrganizationEvent get($primaryKey, $options = [])
 * @method \App\Model\Entity\OrganizationEvent newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OrganizationEvent[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrganizationEvent|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrganizationEvent saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrganizationEvent patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OrganizationEvent[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrganizationEvent findOrCreate($search, callable $callback = null, $options = [])
 */
class OrganizationEventsTable extends Table
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

        $this->setTable('organization_events');
        $this->setDisplayField('organization_event_id');
        $this->setPrimaryKey('organization_event_id');

        $this->belongsTo('Organizations', [
            'foreignKey' => 'organization_id'
        ]);
        $this->belongsTo('Posts', [
            'foreignKey' => 'event_post_id',
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
            ->integer('organization_event_id')
            ->allowEmptyString('organization_event_id', 'create');

        $validator
            ->scalar('organization_event_title')
            ->maxLength('organization_event_title', 255)
            ->requirePresence('organization_event_title', 'create')
            ->allowEmptyString('organization_event_title', false);

        $validator
            ->scalar('organization_event_body')
            ->maxLength('organization_event_body', 255)
            ->requirePresence('organization_event_body', 'create')
            ->allowEmptyString('organization_event_body', false);

        $validator
            ->dateTime('organization_event_created')
            ->allowEmptyDateTime('organization_event_created', false);

        $validator
            ->dateTime('organization_event_modified')
            ->allowEmptyDateTime('organization_event_modified', false);

        $validator
            ->date('organization_event_start_date')
            ->requirePresence('organization_event_start_date', 'create')
            ->allowEmptyDate('organization_event_start_date', false);

        $validator
            ->time('organization_event_start_time')
            ->requirePresence('organization_event_start_time', 'create')
            ->allowEmptyTime('organization_event_start_time', false);

        $validator
            ->date('organization_event_end_date')
            ->requirePresence('organization_event_end_date', 'create')
            ->allowEmptyDate('organization_event_end_date', false);

        $validator
            ->time('organization_event_end_time')
            ->requirePresence('organization_event_end_time', 'create')
            ->allowEmptyTime('organization_event_end_time', false);

        $validator
            ->scalar('organization_event_sponsors')
            ->maxLength('organization_event_sponsors', 255)
            ->allowEmptyString('organization_event_sponsors');

        $validator
            ->scalar('organization_event_participants')
            ->maxLength('organization_event_participants', 255)
            ->requirePresence('organization_event_participants', 'create')
            ->allowEmptyString('organization_event_participants', false);

        $validator
            ->scalar('organization_event_location')
            ->maxLength('organization_event_location', 255)
            ->requirePresence('organization_event_location', 'create')
            ->allowEmptyString('organization_event_location', false);

        $validator
            ->scalar('organization_event_location_embed')
            ->maxLength('organization_event_location_embed', 255)
            ->allowEmptyString('organization_event_location_embed');

        $validator
            ->scalar('organization_event_status')
            ->maxLength('organization_event_status', 255)
            ->requirePresence('organization_event_status', 'create')
            ->allowEmptyString('organization_event_status', false);

        $validator
            ->integer('organization_event_visibility')
            ->requirePresence('organization_event_visibility', 'create')
            ->allowEmptyString('organization_event_visibility', false);

        $validator
            ->scalar('organization_event_photo')
            ->maxLength('organization_event_photo', 255)
            ->allowEmptyString('organization_event_photo');

        $validator
            ->integer('active')
            ->requirePresence('active', 'create')
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
        $rules->add($rules->existsIn(['organization_id'], 'Organizations'));
        $rules->add($rules->existsIn(['event_post_id'], 'Posts'));

        return $rules;
    }
}
