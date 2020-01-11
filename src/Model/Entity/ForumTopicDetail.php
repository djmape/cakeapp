<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ForumTopicDetail Entity
 *
 * @property int $forum_topic_detail_id
 * @property int $forum_topic_detail_discussions_count
 * @property int|null $forum_topic_detail_replies_count
 * @property int $forum_topic_detail_topic_id
 *
 * @property \App\Model\Entity\ForumTopic $forum_topic
 */
class ForumTopicDetail extends Entity
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
        'forum_topic_detail_discussions_count' => true,
        'forum_topic_detail_replies_count' => true,
        'forum_topic_detail_topic_id' => true,
        'forum_topic' => true
    ];
}
