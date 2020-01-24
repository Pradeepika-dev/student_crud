<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('teacher_id')->unsigned()->nullable();
            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->bigInteger('classroom_id')->unsigned()->nullable();
            $table->foreign('classroom_id')->references('id')->on('classrooms');
            $table->string('firstname', 255)->nullable();
            $table->string('lastname', 255)->nullable();
            $table->char('gender', 1)->nullable();
            $table->unsignedInteger('joined_year')->nullable();
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
        Schema::dropIfExists('students');
    }
}
