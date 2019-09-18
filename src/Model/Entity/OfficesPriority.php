<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OfficesPriority Entity
 *
 * @property int $office_priority_id
 * @property int $office_priority
 * @property int $office_id
 *
 * @property \App\Model\Entity\Office $office
 */
class OfficesPriority extends Entity
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
        'office_priority' => true,
        'office_id' => true,
        'office' => true
    ];
}
