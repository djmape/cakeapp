<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserPostActivity Entity
 *
 * @property int $user_post_activity_id
 * @property int $user_post_activity_post_id
 * @property int $user_post_activity_user_id
 * @property int $user_post_activity_type_id
 * @property \Cake\I18n\FrozenTime $user_post_activity_timestamp
 * @property int|null $user_post_activities_user_activity_id
 *
 * @property \App\Model\Entity\Post $post
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\UserPostActivityType $user_post_activity_type
 */
class UserPostActivity extends Entity
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
        'user_post_activity_post_id' => true,
        'user_post_activity_user_id' => true,
        'user_post_activity_type_id' => true,
        'user_post_activity_timestamp' => true,
        'user_post_activities_user_activity_id' => true,
        'post' => true,
        'user' => true,
        'user_post_activity_type' => true
    ];
}
