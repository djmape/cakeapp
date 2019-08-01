<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrganizationOfficersPosition Entity
 *
 * @property int $officers_position_id
 * @property string $officers_position_name
 * @property int $officers_position_priority
 * @property int $active
 *
 * @property \App\Model\Entity\OrganizationOfficer[] $organization_officers
 */
class OrganizationOfficersPosition extends Entity
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
        'officers_position_name' => true,
        'officers_position_priority' => true,
        'active' => true,
        'organization_officers' => true
    ];
}
