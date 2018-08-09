<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'course';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_code',
        'course_name',
        'course_status',
        'course_creditVal',
        'course_coverage',
        'course_instructor',
    ];

    public function saveCourse($data) {
        $this->course_code = $data['course_code'];
        $this->course_name = $data['course_name'];
        $this->course_status = $data['course_status'];
        $this->course_creditVal = $data['course_cv'];
        $this->course_instructor = $data['course_instructor'];
        $this->save();
        return 1;
    }

}
