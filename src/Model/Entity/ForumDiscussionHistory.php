<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ForumDiscussionHistory Entity
 *
 * @property int $forum_discussion_history_id
 * @property string|null $forum_discussion_history_discussion_title
 * @property string|null $forum_discussion_history_discussion_content
 * @property \Cake\I18n\FrozenTime $forum_discussion_history_timestamp_updated
 * @property int $forum_discussion_id
 *
 * @property \App\Model\Entity\ForumDiscussion $forum_discussion
 */
class ForumDiscussionHistory extends Entity
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
        'forum_discussion_history_discussion_title' => true,
        'forum_discussion_history_discussion_content' => true,
        'forum_discussion_history_timestamp_updated' => true,
        'forum_discussion_id' => true,
        'forum_discussion' => true
    ];
}
