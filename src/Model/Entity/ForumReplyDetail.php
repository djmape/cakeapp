<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ForumReplyDetail Entity
 *
 * @property int $forum_reply_detail_id
 * @property int $forum_reply_detail_likes_count
 * @property int $forum_reply_detail_dislikes_count
 * @property string $forum_reply_detail_content
 * @property int $forum_reply_detail_forum_reply_id
 *
 * @property \App\Model\Entity\ForumReply $forum_reply
 */
class ForumReplyDetail extends Entity
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
        'forum_reply_detail_likes_count' => true,
        'forum_reply_detail_dislikes_count' => true,
        'forum_reply_detail_content' => true,
        'forum_reply_detail_forum_reply_id' => true,
        'forum_reply' => true
    ];
}
