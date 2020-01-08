<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserActivityType Entity
 *
 * @property int $user_activity_type_id
 * @property string $user_activity_type_name
 */
class UserActivityType extends Entity
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
        'user_activity_type_name' => true
    ];
}
