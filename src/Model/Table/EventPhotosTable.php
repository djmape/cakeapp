<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EventPhotos Model
 *
 * @property \App\Model\Table\EventsTable|\Cake\ORM\Association\BelongsTo $Events
 *
 * @method \App\Model\Entity\EventPhoto get($primaryKey, $options = [])
 * @method \App\Model\Entity\EventPhoto newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EventPhoto[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EventPhoto|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EventPhoto saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EventPhoto patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EventPhoto[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EventPhoto findOrCreate($search, callable $callback = null, $options = [])
 */
class EventPhotosTable extends Table
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

        $this->setTable('event_photos');
        $this->setDisplayField('photo_id');
        $this->setPrimaryKey('photo_id');

        $this->belongsTo('Events', [
            'foreignKey' => 'event_id',
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
            ->integer('photo_id')
            ->allowEmptyString('photo_id', 'create');

        $validator
            ->scalar('photo_name')
            ->maxLength('photo_name', 255)
            ->requirePresence('photo_name', 'create')
            ->allowEmptyString('photo_name', false);

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
        $rules->add($rules->existsIn(['event_id'], 'Events'));

        return $rules;
    }
}
