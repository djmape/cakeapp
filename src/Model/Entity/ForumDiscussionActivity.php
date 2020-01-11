<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ForumDiscussionActivity Entity
 *
 * @property int $forum_discussion_activity_id
 * @property int $forum_discussion_activity_forum_activity_id
 * @property int $forum_discussion_activity_forum_discussion_id
 *
 * @property \App\Model\Entity\ForumDiscussionActivityForumActivity $forum_discussion_activity_forum_activity
 * @property \App\Model\Entity\ForumDiscussionActivityForumDiscussion $forum_discussion_activity_forum_discussion
 */
class ForumDiscussionActivity extends Entity
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
        'forum_discussion_activity_forum_activity_id' => true,
        'forum_discussion_activity_forum_discussion_id' => true,
        'forum_discussion_activity_forum_activity' => true,
        'forum_discussion_activity_forum_discussion' => true
    ];
}
