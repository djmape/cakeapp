<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Post Entity
 *
 * @property int $post_id
 * @property \Cake\I18n\FrozenTime $post_created
 * @property \Cake\I18n\FrozenTime $post_modified
 * @property int $post_active
 * @property int $post_user_id
 * @property int $post_post_type_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\PostType $post_type
 */
class Post extends Entity
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
        'post_created' => true,
        'post_modified' => true,
        'post_active' => true,
        'post_user_id' => true,
        'post_post_type_id' => true,
        'user' => true,
        'post_type' => true
    ];
}
