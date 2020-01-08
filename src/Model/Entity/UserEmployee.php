<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserEmployee Entity
 *
 * @property int $user_employee_id
 * @property string $user_employee_lastname
 * @property string $user_employee_firstname
 * @property string|null $user_employee_middlename
 * @property string $user_employee_photo
 * @property int $user_employee_active
 * @property int $user_id
 * @property int $user_employee_position_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\EmployeePositionName $employee_position_name
 */
class UserEmployee extends Entity
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
        'user_employee_lastname' => true,
        'user_employee_firstname' => true,
        'user_employee_middlename' => true,
        'user_employee_photo' => true,
        'user_employee_active' => true,
        'user_id' => true,
        'user_employee_position_id' => true,
        'user' => true,
        'employee_position_name' => true
    ];
}
