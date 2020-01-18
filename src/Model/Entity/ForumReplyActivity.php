<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ForumReplyActivity Entity
 *
 * @property int $forum_reply_activity_id
 * @property int $forum_reply_activity_forum_activity_id
 * @property int $forum_reply_activity_forum_reply_id
 *
 * @property \App\Model\Entity\ForumReplyActivityForumActivity $forum_reply_activity_forum_activity
 * @property \App\Model\Entity\ForumReplyActivityForumReply $forum_reply_activity_forum_reply
 */
class ForumReplyActivity extends Entity
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
        'forum_reply_activity_forum_activity_id' => true,
        'forum_reply_activity_forum_reply_id' => true,
        'forum_reply_activity_forum_activity' => true,
        'forum_reply_activity_forum_reply' => true
    ];
}
