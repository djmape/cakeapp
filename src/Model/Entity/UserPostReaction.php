<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserPostReaction Entity
 *
 * @property int $user_post_reactions_id
 * @property bool $user_post_reaction_like
 * @property bool $user_post_reaction_dislike
 * @property int $user_post_reaction_post_id
 * @property int $user_post_reaction_user_id
 * @property int|null $user_post_reaction_post_activity_id
 * @property int|null $user_post_reactions_activity_id
 *
 * @property \App\Model\Entity\Post $post
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\UserPostActivity $user_post_activity
 */
class UserPostReaction extends Entity
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
        'user_post_reaction_like' => true,
        'user_post_reaction_dislike' => true,
        'user_post_reaction_post_id' => true,
        'user_post_reaction_user_id' => true,
        'user_post_reaction_post_activity_id' => true,
        'user_post_reactions_activity_id' => true,
        'post' => true,
        'user' => true,
        'user_post_activity' => true
    ];
}
