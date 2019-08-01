<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrganizationOfficer Entity
 *
 * @property int $organization_officer_id
 * @property string $organization_officer_name
 * @property string $organization_officer_photo
 * @property int $organization_id
 * @property int $officers_position_id
 * @property int $active
 *
 * @property \App\Model\Entity\Organization $organization
 * @property \App\Model\Entity\OrganizationOfficersPosition $organization_officers_position
 */
class OrganizationOfficer extends Entity
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
        'organization_officer_name' => true,
        'organization_officer_photo' => true,
        'organization_id' => true,
        'officers_position_id' => true,
        'active' => true,
        'organization' => true,
        'organization_officers_position' => true
    ];
}
