<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


use Cake\Event\Event;
use Cake\ORM\Entity;

/**
 * Abouts Model
 *
 * @method \App\Model\Entity\About get($primaryKey, $options = [])
 * @method \App\Model\Entity\About newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\About[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\About|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\About saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\About patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\About[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\About findOrCreate($search, callable $callback = null, $options = [])
 */
class AboutsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */

    public function beforeSave(Event $event, Entity $entity) {
        if ($entity->isNew()) {
            return true;
        }
        // edit code
    }

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('abouts');
        $this->setDisplayField('about_id');
        $this->setPrimaryKey('about_id');

        $this->addBehavior('Timestamp');
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
            ->integer('about_id')
            ->allowEmptyString('about_id', 'create');

        $validator
            ->scalar('about_description')
            ->maxLength('about_description', 255)
            ->requirePresence('about_description', 'create')
            ->allowEmptyString('about_description', false);

        $validator
            ->scalar('about_mission')
            ->maxLength('about_mission', 255)
            ->requirePresence('about_mission', 'create')
            ->allowEmptyString('about_mission', false);

        $validator
            ->scalar('about_vision')
            ->maxLength('about_vision', 255)
            ->requirePresence('about_vision', 'create')
            ->allowEmptyString('about_vision', false);

        $validator
            ->scalar('about_goals')
            ->maxLength('about_goals', 255)
            ->requirePresence('about_goals', 'create')
            ->allowEmptyString('about_goals', false);

        $validator
            ->scalar('about_objective')
            ->maxLength('about_objective', 255)
            ->requirePresence('about_objective', 'create')
            ->allowEmptyString('about_objective', false);

        $validator
            ->scalar('about_hymn')
            ->maxLength('about_hymn', 255)
            ->requirePresence('about_hymn', 'create')
            ->allowEmptyString('about_hymn', false);

        $validator
            ->dateTime('about_modified')
            ->requirePresence('about_modified', 'create');

        return $validator;
    }
}
