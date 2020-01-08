<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserAlumnus Entity
 *
 * @property int $user_alumni_id
 * @property string $user_alumni_lastname
 * @property string $user_alumni_firstname
 * @property string|null $user_alumni_middlename
 * @property string $user_alumni_photo
 * @property string|null $user_alumni_student_number
 * @property int|null $user_alumni_year_graduated
 * @property int $course_id
 * @property int $user_id
 *
 * @property \App\Model\Entity\Course $course
 * @property \App\Model\Entity\User $user
 */
class UserAlumnus extends Entity
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
        'user_alumni_lastname' => true,
        'user_alumni_firstname' => true,
        'user_alumni_middlename' => true,
        'user_alumni_photo' => true,
        'user_alumni_student_number' => true,
        'user_alumni_year_graduated' => true,
        'course_id' => true,
        'user_id' => true,
        'course' => true,
        'user' => true
    ];
}
