<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentHasCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_has_course', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('course_id')->nullable();
            $table->foreign('course_id')->references('id')->on('course');
            $table->unsignedInteger('student_id')->nullable();
            $table->foreign('student_id')->references('id')->on('student');
            $table->integer('exam_code');
            $table->integer('course_code');
            $table->integer('student_id_num');
            $table->integer('exam_mark');
            $table->integer('ca_mark');
            $table->integer('total_mark');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_has_course', function (Blueprint $table) {
            Schema::dropIfExists('student_has_course');
        });
    }
}
