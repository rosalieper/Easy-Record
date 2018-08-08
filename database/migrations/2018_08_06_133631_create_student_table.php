<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student', function (Blueprint $table) {
            $table->increments('id');
            //$table->primary('id');
            $table->string('student_id')->unique();
            $table->string('student_name');
            $table->string('student_level');
            $table->string('student_option')->nullable($value = true);
            //$table->dateTime('created_at')->nullable($value = true);
            //$table->dateTime('updated_at')->nullable($value = true);
            $table->rememberToken();
            $table->timestamps();
            $table->unsignedInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('department')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student', function (Blueprint $table) {
            Schema::dropIfExists('student');
        });
    }
}
