<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseExamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_exam', function (Blueprint $table) {
            $table->increments('id');
            $table->string('course_code');
            $table->integer('sat_to_write');
            $table->integer('registered');
            $table->integer('year');
            $table->string('course_instructor');
            $table->float('percentage_pass', 8, 2);
            $table->integer('num_fail');
            $table->integer('num_A');
            $table->integer('num_Bplus');
            $table->integer('num_B');
            $table->integer('num_Cplus');
            $table->integer('num_C');
            $table->integer('num_Dplus');
            $table->integer('num_D');
            $table->integer('num_F');
            $table->integer('num_scripts');
            $table->integer('num_pass_scripts');
            $table->integer('num_fail_scripts');
            $table->integer('dept_success_rate');
            $table->unsignedInteger('course_id')->nullable();
            $table->foreign('course_id')->references('id')->on('course');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_exam', function (Blueprint $table) {
            Schema::dropIfExists('course_exam');
        });
    }
}
