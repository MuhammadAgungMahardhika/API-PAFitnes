<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLecturerClassroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecturer_classrooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lecturer_id');
            $table->foreignId('classroom_id')->constrained('classrooms');
            $table->timestamps();

            $table->foreign('lecturer_id')->references('id')->on('lecturers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lecturer_classrooms');
    }
}
