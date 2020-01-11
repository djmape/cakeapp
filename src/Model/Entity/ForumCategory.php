<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ForumCategory Entity
 *
 * @property int $forum_category_id
 * @property string $forum_category_name
 * @property \Cake\I18n\FrozenTime $forum_category_created
 * @property \Cake\I18n\FrozenTime $forum_category_modified
 * @property int $forum_category_active
 * @property int $forum_category_created_by_user_id
 *
 * @property \App\Model\Entity\User $user
 */
class ForumCategory extends Entity
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
        'forum_category_name' => true,
        'forum_category_created' => true,
        'forum_category_modified' => true,
        'forum_category_active' => true,
        'forum_category_created_by_user_id' => true,
        'user' => true
    ];
}
