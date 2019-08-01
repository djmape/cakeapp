<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Event Entity
 *
 * @property int $event_id
 * @property string $event_title
 * @property string $event_body
 * @property \Cake\I18n\FrozenTime $event_created
 * @property \Cake\I18n\FrozenTime $event_modified
 * @property string|resource $event_photo
 * @property \Cake\I18n\FrozenDate $event_start_date
 * @property \Cake\I18n\FrozenTime $event_start_time
 * @property \Cake\I18n\FrozenDate $event_end_date
 * @property \Cake\I18n\FrozenTime $event_end_time
 */
class Event extends Entity
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
        'event_title' => true,
        'event_body' => true,
        'event_created' => true,
        'event_modified' => true,
        'event_photo' => true,
        'event_start_date' => true,
        'event_start_time' => true,
        'event_end_date' => true,
        'event_end_time' => true
    ];
}
