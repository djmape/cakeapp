<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Announcements Model
 *
 * @method \App\Model\Entity\Announcement get($primaryKey, $options = [])
 * @method \App\Model\Entity\Announcement newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Announcement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Announcement|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Announcement saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Announcement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Announcement[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Announcement findOrCreate($search, callable $callback = null, $options = [])
 */
class AnnouncementsTable extends Table
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

        $this->setTable('announcements');
        $this->setDisplayField('announcement_id');
        $this->setPrimaryKey('announcement_id');
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
            ->integer('announcement_id')
            ->allowEmptyString('announcement_id', 'create');

        $validator
            ->scalar('announcement_title')
            ->maxLength('announcement_title', 255)
            ->requirePresence('announcement_title', 'create')
            ->allowEmptyString('announcement_title', false);

        $validator
            ->scalar('announcement_body')
            ->maxLength('announcement_body', 255)
            ->requirePresence('announcement_body', 'create')
            ->allowEmptyString('announcement_body', false);

        $validator
            ->dateTime('announcement_created')
            ->allowEmptyDateTime('announcement_created', false);

        $validator
            ->dateTime('announcement_modified')
            ->allowEmptyDateTime('announcement_modified', false);


        return $validator;
    }
}
