<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EmployeePosition Entity
 *
 * @property int $employee_position_id
 * @property string $employee_position_name
 * @property int $employee_position_priority
 * @property int $active
 *
 * @property \App\Model\Entity\Employee[] $employees
 * @property \App\Model\Entity\EmployeePosition[] $employee_positions
 */
class EmployeePosition extends Entity
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
        'employees' => true,
        'employee_positions' => true
    ];
}
