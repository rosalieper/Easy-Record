<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $table = 'student';
    /**
    *
    *@var array
    */
    protected $fillable = ['student_id_num', 'student_name', 'student_level', 'student_option'];

    /**
    *
    */
    public function student_course(){
    	return $this->hasMany(App/CourseStudent);
    }

    public function saveStudent($data)
    {
        $this->student_id_num = $data['student_id_num'];
        $this->student_name = $data['student_name'];
        $this->student_level = $data['student_level'];
        $this->student_option = $data['student_option'];
        $this->save();
        return 1;
    }
    public function updateStudent($data)
    {
        $ticket = $this->find($data['matricule']);
        //$ticket->user_id = auth()->user()->id;
        $ticket->title = $data['name'];
        $ticket->description = $data['option'];
        $ticket->save();
        return 1;
    }
}
