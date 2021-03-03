<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EmployeePositionName Entity
 *
 * @property int $employee_position_id
 * @property string $employee_position_name
 * @property int $employee_position_priority
 * @property int $active
 * @property string|null $employee_position_description
 *
 * @property \App\Model\Entity\UserEmployee[] $user__employees
 */
class EmployeePositionName extends Entity
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
        'employee_position_name' => true,
        'employee_position_priority' => true,
        'active' => true,
        'employee_position_description' => true,
        'user__employees' => true
    ];
}
