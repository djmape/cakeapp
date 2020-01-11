<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ForumDiscussion Entity
 *
 * @property int $forum_discussion_id
 * @property string $forum_discussion_title
 * @property \Cake\I18n\FrozenTime $forum_discussion_created
 * @property \Cake\I18n\FrozenTime $forum_discussion_updated
 * @property int $forum_discussion_active
 * @property int $forum_discussion_created_by_user_id
 * @property int $forum_discussion_topic_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\ForumDiscussionDetail $forum_discussion_detail
 */
class ForumDiscussion extends Entity
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
        'forum_discussion_title' => true,
        'forum_discussion_created' => true,
        'forum_discussion_updated' => true,
        'forum_discussion_active' => true,
        'forum_discussion_created_by_user_id' => true,
        'forum_discussion_topic_id' => true,
        'user' => true,
        'forum_discussion_detail' => true
    ];
}
