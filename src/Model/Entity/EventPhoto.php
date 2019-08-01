<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EventPhoto Entity
 *
 * @property int $photo_id
 * @property string $photo_name
 * @property int $event_id
 *
 * @property \App\Model\Entity\Event $event
 */
class EventPhoto extends Entity
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
        'photo_name' => true,
        'event_id' => true,
        'event' => true
    ];
}
