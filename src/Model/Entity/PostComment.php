<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PostComment Entity
 *
 * @property int $post_comment_id
 * @property \Cake\I18n\FrozenTime $post_comment_timestamp
 * @property int $post_comment_user_id
 * @property int $post_comment_post_id
 * @property int|null $post_comment_post_activity_id
 * @property int|null $post_comment_activity_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Post $post
 * @property \App\Model\Entity\UserPostActivity $user_post_activity
 * @property \App\Model\Entity\PostCommentContent[] $post_comment_contents
 */
class PostComment extends Entity
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
        'post_comment_timestamp' => true,
        'post_comment_user_id' => true,
        'post_comment_post_id' => true,
        'post_comment_post_activity_id' => true,
        'post_comment_activity_id' => true,
        'user' => true,
        'post' => true,
        'user_post_activity' => true,
        'post_comment_contents' => true
    ];
}
