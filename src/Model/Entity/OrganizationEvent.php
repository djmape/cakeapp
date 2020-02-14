<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrganizationEvent Entity
 *
 * @property int $organization_event_id
 * @property string $organization_event_title
 * @property string $organization_event_body
 * @property \Cake\I18n\FrozenTime $organization_event_created
 * @property \Cake\I18n\FrozenTime $organization_event_modified
 * @property \Cake\I18n\FrozenDate $organization_event_start_date
 * @property \Cake\I18n\FrozenTime $organization_event_start_time
 * @property \Cake\I18n\FrozenDate $organization_event_end_date
 * @property \Cake\I18n\FrozenTime $organization_event_end_time
 * @property string|null $organization_event_sponsors
 * @property string $organization_event_participants
 * @property string $organization_event_location
 * @property string|null $organization_event_location_embed
 * @property string $organization_event_status
 * @property int $organization_event_visibility
 * @property string|null $organization_event_photo
 * @property int $active
 * @property bool|null $organization_announcement_visibility_members_only
 * @property int|null $organization_id
 * @property int $event_post_id
 *
 * @property \App\Model\Entity\Organization $organization
 * @property \App\Model\Entity\Post $post
 */
class OrganizationEvent extends Entity
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
        'organization_event_title' => true,
        'organization_event_body' => true,
        'organization_event_created' => true,
        'organization_event_modified' => true,
        'organization_event_start_date' => true,
        'organization_event_start_time' => true,
        'organization_event_end_date' => true,
        'organization_event_end_time' => true,
        'organization_event_sponsors' => true,
        'organization_event_participants' => true,
        'organization_event_location' => true,
        'organization_event_location_embed' => true,
        'organization_event_status' => true,
        'organization_event_visibility' => true,
        'organization_event_photo' => true,
        'active' => true,
        'organization_announcement_visibility_members_only' => true,
        'organization_id' => true,
        'event_post_id' => true,
        'organization' => true,
        'post' => true
    ];
}
