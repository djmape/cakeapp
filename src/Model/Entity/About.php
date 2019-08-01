<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * About Entity
 *
 * @property int $about_id
 * @property string $about_description
 * @property string $about_mission
 * @property string $about_vision
 * @property string $about_goals
 * @property string $about_objective
 * @property string $about_hymn
 * @property \Cake\I18n\FrozenTime $about_modified
 * @property string|null $about_additional_info
 */
class About extends Entity
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
        'about_description' => true,
        'about_mission' => true,
        'about_vision' => true,
        'about_goals' => true,
        'about_objective' => true,
        'about_hymn' => true,
        'about_modified' => true,
        'about_additional_info' => true
    ];
}
