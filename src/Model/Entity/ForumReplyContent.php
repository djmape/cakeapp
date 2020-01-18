<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ForumReplyContent Entity
 *
 * @property int $forum_reply_content_d
 * @property string $forum_reply_content
 * @property int $forum_reply_content_forum_reply_id
 *
 * @property \App\Model\Entity\ForumReplyContentForumReply $forum_reply_content_forum_reply
 */
class ForumReplyContent extends Entity
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
        'forum_reply_content' => true,
        'forum_reply_content_forum_reply_id' => true,
        'forum_reply_content_forum_reply' => true
    ];
}
