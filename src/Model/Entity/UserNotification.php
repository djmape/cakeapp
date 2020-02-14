<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserNotification Entity
 *
 * @property int $user_notification_id
 * @property \Cake\I18n\FrozenTime $user_notification_created
 * @property bool $user_notification_read_status
 * @property \Cake\I18n\FrozenTime $user_notification_date_read
 * @property int $user_notification_receiver_user_id
 *
 * @property \App\Model\Entity\User $user
 */
class UserNotification extends Entity
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
        'user_notification_created' => true,
        'user_notification_read_status' => true,
        'user_notification_date_read' => true,
        'user_notification_receiver_user_id' => true,
        'user' => true
    ];
}
