<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrganizationAnnouncement Entity
 *
 * @property int $organization_announcement_id
 * @property string $organization_announcement_title
 * @property string $organization_announcement_body
 * @property \Cake\I18n\FrozenTime $organization_announcement_created
 * @property \Cake\I18n\FrozenTime $organization_announcement_modified
 * @property int $active
 * @property int $announcement_post_id
 * @property bool|null $organization_announcement_visibility_members_only
 * @property int|null $organization_id
 *
 * @property \App\Model\Entity\Post $post
 */
class OrganizationAnnouncement extends Entity
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
        'organization_announcement_title' => true,
        'organization_announcement_body' => true,
        'organization_announcement_created' => true,
        'organization_announcement_modified' => true,
        'active' => true,
        'announcement_post_id' => true,
        'organization_announcement_visibility_members_only' => true,
        'organization_id' => true,
        'post' => true
    ];
}
