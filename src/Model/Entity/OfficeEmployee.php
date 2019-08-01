<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OfficeEmployee Entity
 *
 * @property int $office_employees_id
 * @property int $office_id
 * @property int $employee_id
 * @property int $office_position_id
 * @property int $active
 *
 * @property \App\Model\Entity\Office $office
 * @property \App\Model\Entity\Employee $employee
 * @property \App\Model\Entity\OfficePosition $office_position
 */
class OfficeEmployee extends Entity
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
        'office_id' => true,
        'employee_id' => true,
        'office_position_id' => true,
        'active' => true,
        'office' => true,
        'employee' => true,
        'office_position' => true
    ];
}
