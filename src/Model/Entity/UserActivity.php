<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserActivity Entity
 *
 * @property int $user_activity_id
 * @property \Cake\I18n\FrozenTime $user_activity_timestamp
 * @property int $user_activity_activity_type_id
 * @property int $user_activity_user_id
 * @property int|null $user_activity_reference_no
 * @property int|null $user_activity_post_id
 *
 * @property \App\Model\Entity\UserActivityActivityType $user_activity_activity_type
 * @property \App\Model\Entity\UserActivityUser $user_activity_user
 * @property \App\Model\Entity\UserActivityPost $user_activity_post
 */
class UserActivity extends Entity
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
        'user_activity_timestamp' => true,
        'user_activity_activity_type_id' => true,
        'user_activity_user_id' => true,
        'user_activity_reference_no' => true,
        'user_activity_post_id' => true,
        'user_activity_activity_type' => true,
        'user_activity_user' => true,
        'user_activity_post' => true
    ];
}
