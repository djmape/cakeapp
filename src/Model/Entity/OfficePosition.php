<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OfficePosition Entity
 *
 * @property int $office_position_id
 * @property string $office_position_name
 * @property int $office_position_priority
 * @property int $active
 */
class OfficePosition extends Entity
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
        'office_position_name' => true,
        'office_position_priority' => true,
        'active' => true
    ];
}
