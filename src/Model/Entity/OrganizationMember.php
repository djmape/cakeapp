<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrganizationMember Entity
 *
 * @property int $organization_member_id
 * @property int $organization_id
 * @property int $user_id
 * @property int $active
 *
 * @property \App\Model\Entity\Organization $organization
 * @property \App\Model\Entity\User $user
 */
class OrganizationMember extends Entity
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
        'organization_id' => true,
        'user_id' => true,
        'active' => true,
        'organization' => true,
        'user' => true
    ];
}
