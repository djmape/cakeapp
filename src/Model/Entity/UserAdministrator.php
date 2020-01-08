<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserAdministrator Entity
 *
 * @property int $admin_id
 * @property string $admin_lastname
 * @property string $admin_firstname
 * @property string|null $admin_middlename
 * @property string $admin_photo
 * @property int $user_id
 * @property int $admin_active
 *
 * @property \App\Model\Entity\User $user
 */
class UserAdministrator extends Entity
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
        'admin_lastname' => true,
        'admin_firstname' => true,
        'admin_middlename' => true,
        'admin_photo' => true,
        'user_id' => true,
        'admin_active' => true,
        'user' => true
    ];
}
