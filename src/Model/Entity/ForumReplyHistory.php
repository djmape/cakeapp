<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ForumReplyHistory Entity
 *
 * @property int $forum_reply_history_id
 * @property string|null $forum_reply_history_reply_content
 * @property \Cake\I18n\FrozenTime $forum_reply_history_reply_timestamp_updated
 * @property int $forum_reply_id
 *
 * @property \App\Model\Entity\ForumReply $forum_reply
 */
class ForumReplyHistory extends Entity
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
        'forum_reply_history_reply_content' => true,
        'forum_reply_history_reply_timestamp_updated' => true,
        'forum_reply_id' => true,
        'forum_reply' => true
    ];
}
