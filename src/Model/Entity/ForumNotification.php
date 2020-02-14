<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ForumNotification Entity
 *
 * @property int $forum_notification_id
 * @property int $user_notification_id
 * @property int $forum_notification_sender_user_id
 * @property int $forum_notification_type_id
 * @property int|null $forum_notification_discussion_id
 * @property int|null $forum_notification_reply_id
 *
 * @property \App\Model\Entity\UserNotification $user_notification
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\ForumNotificationType $forum_notification_type
 * @property \App\Model\Entity\ForumDiscussion $forum_discussion
 * @property \App\Model\Entity\ForumReply $forum_reply
 */
class ForumNotification extends Entity
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
        'user_notification_id' => true,
        'forum_notification_sender_user_id' => true,
        'forum_notification_type_id' => true,
        'forum_notification_discussion_id' => true,
        'forum_notification_reply_id' => true,
        'user_notification' => true,
        'user' => true,
        'forum_notification_type' => true,
        'forum_discussion' => true,
        'forum_reply' => true
    ];
}
