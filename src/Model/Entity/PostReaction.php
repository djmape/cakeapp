<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PostReaction Entity
 *
 * @property int $post_reactions_id
 * @property int $post_comments_count
 * @property int $post_likes_count
 * @property int $post_dislikes_count
 * @property int $post_reactions_post_id
 *
 * @property \App\Model\Entity\Post $post
 */
class PostReaction extends Entity
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
        'post_comments_count' => true,
        'post_likes_count' => true,
        'post_dislikes_count' => true,
        'post_reactions_post_id' => true,
        'post' => true
    ];
}
