<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Announcement Entity
 *
 * @property int $announcement_id
 * @property string $announcement_title
 * @property string $announcement_body
 * @property \Cake\I18n\FrozenTime $announcement_created
 * @property \Cake\I18n\FrozenTime $announcement_modified
 * @property string|resource|null $announcement_photo
 */
class Announcement extends Entity
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
        'announcement_title' => true,
        'announcement_body' => true,
        'announcement_created' => true,
        'announcement_modified' => true,
        'announcement_photo' => true
    ];
}
