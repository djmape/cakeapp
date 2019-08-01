<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Course Entity
 *
 * @property int $course_id
 * @property string $course_name
 * @property string $course_acronym
 * @property int $organization_id
 * @property string $course_mission
 * @property string $course_vision
 * @property string $course_goal
 * @property string $course_objective
 * @property int $course_type_id
 *
 * @property \App\Model\Entity\Organization $organization
 * @property \App\Model\Entity\CourseType $course_type
 */
class Course extends Entity
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
        'course_name' => true,
        'course_acronym' => true,
        'organization_id' => true,
        'course_mission' => true,
        'course_vision' => true,
        'course_goal' => true,
        'course_objective' => true,
        'course_type_id' => true,
        'organization' => true,
        'course_type' => true
    ];
}
