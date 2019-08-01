<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ContactNumber Entity
 *
 * @property int $contact_number_id
 * @property string $contact_number
 * @property int $active
 */
class ContactNumber extends Entity
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
        'contact_number' => true,
        'active' => true
    ];
}
