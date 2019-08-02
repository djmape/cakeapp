<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * HomeCarouselImg Entity
 *
 * @property int $home_carousel_img_id
 * @property string $home_carousel_img_name
 * @property int $active
 * @property string|null $home_carousel_img_caption
 * @property string|null $home_carousel_img_description
 * @property int $visibility
 */
class HomeCarouselImg extends Entity
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
        'home_carousel_img_name' => true,
        'active' => true,
        'home_carousel_img_caption' => true,
        'home_carousel_img_description' => true,
        'visibility' => true
    ];
}
