<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Employee Entity
 *
 * @property int $employee_id
 * @property string $employee_lastname
 * @property string $employee_firstname
 * @property string|null $employee_middlename
 * @property string $employee_type
 * @property int $employee_position_id
 * @property string $employee_photo
 * @property string|null $employee_email
 * @property int $active
 *
 * @property \App\Model\Entity\EmployeePosition $employee_position
 * @property \App\Model\Entity\OfficeEmployee[] $office_employees
 */
class Employee extends Entity
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
        'employee_lastname' => true,
        'employee_firstname' => true,
        'employee_middlename' => true,
        'employee_type' => true,
        'employee_position_id' => true,
        'employee_photo' => true,
        'employee_email' => true,
        'active' => true,
        'employee_position' => true,
        'office_employees' => true
    ];
}
