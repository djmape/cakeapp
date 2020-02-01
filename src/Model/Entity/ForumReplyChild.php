<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ForumReplyChild Entity
 *
 * @property int $forum_reply_child_id
 * @property int $forum_reply_child_reply_id
 * @property int $forum_reply_parent_reply_id
 *
 * @property \App\Model\Entity\ForumReply $forum_child_reply
 * @property \App\Model\Entity\ForumReply $forum_parent_reply
 */
class ForumReplyChild extends Entity
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
        'forum_reply_child_reply_id' => true,
        'forum_reply_parent_reply_id' => true,
        'forum_child_reply' => true,
        'forum_parent_reply' => true
    ];
}
