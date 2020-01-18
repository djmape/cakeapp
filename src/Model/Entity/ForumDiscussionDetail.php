<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ForumDiscussionDetail Entity
 *
 * @property int $forum_discussion_detail_id
 * @property int|null $forum_discussion_detail_replies_count
 * @property int $forum_discussion_detail_discussion_id
 * @property string|null $forum_discussion_content
 *
 * @property \App\Model\Entity\ForumDiscussion $forum_discussion
 */
class ForumDiscussionDetail extends Entity
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
        'forum_discussion_detail_replies_count' => true,
        'forum_discussion_detail_discussion_id' => true,
        'forum_discussion_content' => true,
        'forum_discussion' => true
    ];
}
