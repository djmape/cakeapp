<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserStudent Entity
 *
 * @property int $user_student_id
 * @property string $user_student_lastname
 * @property string $user_student_firstname
 * @property string|null $user_student_middlename
 * @property string $user_student_photo
 * @property string|null $user_student_number
 * @property int $course_id
 * @property int $user_id
 *
 * @property \App\Model\Entity\Course $course
 * @property \App\Model\Entity\User $user
 */
class UserStudent extends Entity
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
        'user_student_lastname' => true,
        'user_student_firstname' => true,
        'user_student_middlename' => true,
        'user_student_photo' => true,
        'user_student_number' => true,
        'course_id' => true,
        'user_id' => true,
        'course' => true,
        'user' => true
    ];
}
