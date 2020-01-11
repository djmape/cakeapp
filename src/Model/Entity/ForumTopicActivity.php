<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ForumTopicActivity Entity
 *
 * @property int $forum_topic_activity_id
 * @property int $forum_topic_activity_forum_activity_id
 * @property int $forum_topic_activity_forum_topic_id
 *
 * @property \App\Model\Entity\ForumTopicActivityForumActivity $forum_topic_activity_forum_activity
 * @property \App\Model\Entity\ForumTopicActivityForumTopic $forum_topic_activity_forum_topic
 */
class ForumTopicActivity extends Entity
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
        'forum_topic_activity_forum_activity_id' => true,
        'forum_topic_activity_forum_topic_id' => true,
        'forum_topic_activity_forum_activity' => true,
        'forum_topic_activity_forum_topic' => true
    ];
}
