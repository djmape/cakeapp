<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ForumTopicHistory Entity
 *
 * @property int $forum_topic_history_id
 * @property string|null $forum_topic_history_topic_name
 * @property \Cake\I18n\FrozenTime $forum_topic_history_timestamp_updated
 * @property int $forum_topic_id
 *
 * @property \App\Model\Entity\ForumTopic $forum_topic
 */
class ForumTopicHistory extends Entity
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
        'forum_topic_history_topic_name' => true,
        'forum_topic_history_timestamp_updated' => true,
        'forum_topic_id' => true,
        'forum_topic' => true
    ];
}
