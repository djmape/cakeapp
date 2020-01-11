<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ForumCategoryActivity Entity
 *
 * @property int $forum_category_activity_id
 * @property int $forum_category_activity_forum_activity_id
 * @property int $forum_category_activity_forum_category_id
 *
 * @property \App\Model\Entity\ForumActivity $forum_activity
 * @property \App\Model\Entity\ForumCategory $forum_category
 */
class ForumCategoryActivity extends Entity
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
        'forum_category_activity_forum_activity_id' => true,
        'forum_category_activity_forum_category_id' => true,
        'forum_activity' => true,
        'forum_category' => true
    ];
}
