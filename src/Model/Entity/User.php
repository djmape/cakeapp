<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string|null $user_photo
 * @property int $user_type_id
 * @property int $active
 * @property string $username
 *
 * @property \App\Model\Entity\UserType $user_type
 * @property \App\Model\Entity\Article[] $articles
 * @property \App\Model\Entity\UserAdministrator[] $user_administrators
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'email' => true,
        'password' => true,
        'created' => true,
        'modified' => true,
        'user_photo' => true,
        'user_type_id' => true,
        'active' => true,
        'username' => true,
        'user_type' => true,
        'articles' => true,
        'user_administrators' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
