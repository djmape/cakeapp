<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserProfile Entity
 *
 * @property int $user_profile_id
 * @property string $user_profile_photo
 * @property string $user_cover_photo
 * @property string $user_profile_background
 * @property string|null $user_profile_bio
 * @property int $user_profile_user_id
 *
 * @property \App\Model\Entity\User $user
 */
class UserProfile extends Entity
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
        'user_profile_photo' => true,
        'user_cover_photo' => true,
        'user_profile_background' => true,
        'user_profile_bio' => true,
        'user_profile_user_id' => true,
        'user' => true
    ];
}
