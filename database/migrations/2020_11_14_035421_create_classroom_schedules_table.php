<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassroomSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classroom_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('scheduled_day');
            $table->time('start_time');
            $table->time('finish_time');
            $table->foreignId('classroom_id')->constrained('classrooms');
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
        Schema::dropIfExists('classroom_schedules');
    }
}
