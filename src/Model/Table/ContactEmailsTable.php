<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ContactEmails Model
 *
 * @method \App\Model\Entity\ContactEmail get($primaryKey, $options = [])
 * @method \App\Model\Entity\ContactEmail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ContactEmail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ContactEmail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ContactEmail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ContactEmail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ContactEmail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ContactEmail findOrCreate($search, callable $callback = null, $options = [])
 */
class ContactEmailsTable extends Table
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

        $this->setTable('contact_emails');
        $this->setDisplayField('contact_email_id');
        $this->setPrimaryKey('contact_email_id');
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
            ->integer('contact_email_id')
            ->allowEmptyString('contact_email_id', 'create');

        $validator
            ->scalar('contact_email')
            ->maxLength('contact_email', 255)
            ->requirePresence('contact_email', 'create')
            ->allowEmptyString('contact_email', false);

        $validator
            ->integer('active')
            ->requirePresence('active', 'create')
            ->allowEmptyString('active', false);

        return $validator;
    }
}
