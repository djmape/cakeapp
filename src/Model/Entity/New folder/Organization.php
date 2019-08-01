<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Organization Entity
 *
 * @property int $organization_id
 * @property string $organization_name
 * @property string $organization_acronym
 * @property string $organization_mission
 * @property string $organization_vision
 * @property string $organization_goal
 * @property string $organization_objective
 * @property string|null $organization_photo
 * @property int $organization_status
 * @property string $organization_type
 */
class Organization extends Entity
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
        'organization_name' => true,
        'organization_acronym' => true,
        'organization_mission' => true,
        'organization_vision' => true,
        'organization_goal' => true,
        'organization_objective' => true,
        'organization_photo' => true,
        'organization_status' => true,
        'organization_type' => true
    ];
}
