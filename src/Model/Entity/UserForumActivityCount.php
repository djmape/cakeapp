<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserForumActivityCount Entity
 *
 * @property int $user_forum_activity_count_id
 * @property int $user_forum_activity_categories_count
 * @property int $user_forum_activity_topics_count
 * @property int $user_forum_activity_discussions_count
 * @property int $user_forum_activity_replies_count
 * @property int $user_forum_activity_reactions_count
 * @property int $user_id
 *
 * @property \App\Model\Entity\User $user
 */
class UserForumActivityCount extends Entity
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
        'user_forum_activity_categories_count' => true,
        'user_forum_activity_topics_count' => true,
        'user_forum_activity_discussions_count' => true,
        'user_forum_activity_replies_count' => true,
        'user_forum_activity_reactions_count' => true,
        'user_id' => true,
        'user' => true
    ];
}
