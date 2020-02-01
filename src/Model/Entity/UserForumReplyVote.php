<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserForumReplyVote Entity
 *
 * @property int $forum_reply_vote_id
 * @property bool $forum_reply_vote_upvote
 * @property bool $forum_reply_vote_downvote
 * @property int $forum_reply_id
 * @property int $user_id
 *
 * @property \App\Model\Entity\ForumReply $forum_reply
 * @property \App\Model\Entity\User $user
 */
class UserForumReplyVote extends Entity
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
        'forum_reply_vote_upvote' => true,
        'forum_reply_vote_downvote' => true,
        'forum_reply_id' => true,
        'user_id' => true,
        'forum_reply' => true,
        'user' => true
    ];
}
