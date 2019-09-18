<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Office Entity
 *
 * @property int $office_id
 * @property string $office_name
 * @property string $office_description
 * @property int $active
 * @property string|null $office_photo
 * @property int $priority
 *
 * @property \App\Model\Entity\OfficeEmployee[] $office_employees
 */
class Office extends Entity
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
        'office_name' => true,
        'office_description' => true,
        'active' => true,
        'office_photo' => true,
        'priority' => true,
        'office_employees' => true
    ];
}
