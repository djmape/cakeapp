<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserForumDiscussionVote Entity
 *
 * @property int $forum_discussion_vote_id
 * @property int $forum_discussion_vote_upvote_count
 * @property int $forum_discussion_vote_downvote_count
 * @property int $forum_discussion_id
 * @property int $user_id
 *
 * @property \App\Model\Entity\ForumDiscussion $forum_discussion
 */
class UserForumDiscussionVote extends Entity
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
        'forum_discussion_vote_upvote_count' => true,
        'forum_discussion_vote_downvote_count' => true,
        'forum_discussion_id' => true,
        'user_id' => true,
        'forum_discussion' => true
    ];
}
