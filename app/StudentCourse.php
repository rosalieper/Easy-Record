<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    //
    //
    protected $table = 'student_has_course';
    /**
    *
    *@var array
    */
    protected $fillable = ['id', 'course_id', 'student_id', 'exam_code', 'course_code', 'student_id_num', 'exam_mark', 'ca_mark', 'total_mark'];

}
