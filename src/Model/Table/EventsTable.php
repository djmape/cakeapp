<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Events Model
 *
 * @method \App\Model\Entity\Event get($primaryKey, $options = [])
 * @method \App\Model\Entity\Event newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Event[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Event|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Event saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Event patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Event[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Event findOrCreate($search, callable $callback = null, $options = [])
 */
class EventsTable extends Table
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

        $this->setTable('events');
        $this->setDisplayField('event_id');
        $this->setPrimaryKey('event_id');
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
            ->integer('event_id')
            ->allowEmptyString('event_id', 'create');

        $validator
            ->scalar('event_title')
            ->maxLength('event_title', 2550)
            ->requirePresence('event_title', 'create')
            ->allowEmptyString('event_title', false);

        $validator
            ->scalar('event_body')
            ->maxLength('event_body', 10000)
            ->requirePresence('event_body', 'create')
            ->allowEmptyString('event_body', false);

        $validator
            ->dateTime('event_created')
            ->allowEmptyDateTime('event_created', false);

        $validator
            ->dateTime('event_modified')
            ->allowEmptyDateTime('event_modified', false);

        $validator
            ->date('event_start_date')
            ->requirePresence('event_start_date', 'create')
            ->allowEmptyDate('event_start_date', false);

        $validator
            ->time('event_start_time')
            ->requirePresence('event_start_time', 'create')
            ->allowEmptyTime('event_start_time', false);

        $validator
            ->date('event_end_date')
            ->requirePresence('event_end_date', 'create')
            ->allowEmptyDate('event_end_date', false);

        $validator
            ->time('event_end_time')
            ->requirePresence('event_end_time', 'create')
            ->allowEmptyTime('event_end_time', false);

        $validator
            ->scalar('event_sponsors')
            ->maxLength('event_sponsors', 2550)
            ->allowEmptyString('event_sponsors');

        $validator
            ->scalar('event_participants')
            ->maxLength('event_participants', 2550)
            ->requirePresence('event_participants', 'create')
            ->allowEmptyString('event_participants', false);

        $validator
            ->scalar('event_location')
            ->maxLength('event_location', 2550)
            ->requirePresence('event_location', 'create')
            ->allowEmptyString('event_location', false);

        $validator
            ->scalar('event_location_embed')
            ->maxLength('event_location_embed', 2550)
            ->allowEmptyString('event_location_embed');

        $validator
            ->scalar('event_status')
            ->maxLength('event_status', 255)
            ->requirePresence('event_status', 'create')
            ->allowEmptyString('event_status', false);

        $validator
            ->integer('event_visibility')
            ->requirePresence('event_visibility', 'create')
            ->allowEmptyString('event_visibility', false);

        $validator
            ->scalar('event_photo')
            ->maxLength('event_photo', 2550)
            ->allowEmptyString('event_photo');

        $validator
            ->integer('active')
            ->requirePresence('active', 'create')
            ->allowEmptyString('active', false);

        return $validator;
    }
}
