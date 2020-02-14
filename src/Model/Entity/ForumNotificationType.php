<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ForumNotificationType Entity
 *
 * @property int $forum_notification_type_id
 * @property string $forum_notification_type_name
 */
class ForumNotificationType extends Entity
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
        'forum_notification_type_name' => true
    ];
}
