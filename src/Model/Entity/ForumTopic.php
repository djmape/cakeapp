<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ForumTopic Entity
 *
 * @property int $forum_topic_id
 * @property string $forum_topic_name
 * @property \Cake\I18n\FrozenTime $forum_topic_created
 * @property \Cake\I18n\FrozenTime $forum_topic_modified
 * @property int $forum_topic_active
 * @property int $forum_topic_created_by_user_id
 * @property int $forum_topic_category_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\ForumCategory $forum_category
 * @property \App\Model\Entity\ForumTopicDetail $forum_topic_detail
 */
class ForumTopic extends Entity
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
        'forum_topic_name' => true,
        'forum_topic_created' => true,
        'forum_topic_modified' => true,
        'forum_topic_active' => true,
        'forum_topic_created_by_user_id' => true,
        'forum_topic_category_id' => true,
        'user' => true,
        'forum_category' => true,
        'forum_topic_detail' => true
    ];
}
