<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNeedsReviewToStudentAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_attendances', function (Blueprint $table) {
            $table->boolean('needs_review')->default(false)->after('presence_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_attendances', function (Blueprint $table) {
            $table->dropColumn('needs_review');
        });
    }
}
