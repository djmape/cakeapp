<?php 
//in src/Form/EmailForm.php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class EmailForm extends Form
{

    public function _buildSchema(Schema $schema)
    {
        return $schema->addField('name', 'string')
            ->addField('subject', 'string')
            ->addField('event', 'string')
            ->addField('email', ['type' => 'string'])
            ->addField('message', ['type' => 'text']);
    }

    public function validationDefault(Validator $validator)
    {
        $validator->add('name', 'length', [
                'rule' => ['minLength', 10],
                'message' => 'A name is required'
            ])->add('subject', 'length', [
                'rule' => ['minLength', 10],
                'message' => 'A subject is required'
            ])->add('email', 'format', [
                'rule' => 'email',
                'message' => 'A valid email address is required',
            ]);

        return $validator;
    }

    public function _execute(array $data)
    {
        // Send an email.
        return true;
    }
}