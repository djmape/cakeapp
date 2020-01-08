<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PostCommentContent Entity
 *
 * @property int $post_comment_content_id
 * @property string $post_comment_content
 * @property int $post_comment_content_post_comment_id
 *
 * @property \App\Model\Entity\PostComment $post_comment
 */
class PostCommentContent extends Entity
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
        'post_comment_content' => true,
        'post_comment_content_post_comment_id' => true,
        'post_comment' => true
    ];
}
