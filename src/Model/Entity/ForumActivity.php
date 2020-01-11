<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ForumActivity Entity
 *
 * @property int $forum_activity_id
 * @property \Cake\I18n\FrozenTime $forum_activity_created
 * @property int $forum_activity_type_id
 * @property int $forum_activity_user_id
 * @property int $forum_activity_activity_id
 *
 * @property \App\Model\Entity\ForumActivityType $forum_activity_type
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\UserActivity $user_activity
 */
class ForumActivity extends Entity
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
        'forum_activity_created' => true,
        'forum_activity_type_id' => true,
        'forum_activity_user_id' => true,
        'forum_activity_activity_id' => true,
        'forum_activity_type' => true,
        'user' => true,
        'user_activity' => true
    ];
}
