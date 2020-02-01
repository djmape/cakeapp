<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ForumReply Entity
 *
 * @property int $forum_reply_id
 * @property \Cake\I18n\FrozenTime $forum_reply_created
 * @property \Cake\I18n\FrozenTime $forum_reply_updated
 * @property int $forum_reply_active
 * @property int $forum_reply_created_by_user_id
 * @property int $forum_discussion_id
 * @property int|null $forum_parent_reply_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\ForumDiscussion $forum_discussion
 * @property \App\Model\Entity\ForumReplyActivity $forum_reply_activity
 * @property \App\Model\Entity\ForumReplyDetail $forum_reply_detail
 */
class ForumReply extends Entity
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
        'forum_reply_created' => true,
        'forum_reply_updated' => true,
        'forum_reply_active' => true,
        'forum_reply_created_by_user_id' => true,
        'forum_discussion_id' => true,
        'forum_parent_reply_id' => true,
        'user' => true,
        'forum_discussion' => true,
        'forum_reply_activity' => true,
        'forum_reply_detail' => true
    ];
}
