<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course', function (Blueprint $table) {
            $table->increments('id');
            $table->string('course_code')->unique();
            $table->string('course_name');
            $table->string('course_status');
            $table->string('course_creditVal');
            $table->string('course_coverage');
            $table->string('course_instructor');
            //$table->string('created_at')->nullable($value = true);
            //$table->string('updated_at')->nullable($value = true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course', function (Blueprint $table) {
            Schema::dropIfExists('course');
        });
    }
}
