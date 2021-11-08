<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_locations', function (Blueprint $table) {
            $table->id();
            $table->decimal('longitude');
            $table->decimal('latitude');
            $table->string('address');
            $table->foreignId('student_id');
            $table->string('submission_status')->nullable();
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_locations');
    }
}
