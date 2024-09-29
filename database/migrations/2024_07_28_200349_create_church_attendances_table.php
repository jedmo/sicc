<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('church_attendances', function (Blueprint $table) {
            $table->id();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('sibling_attendance_1d')->nullable()->default(0);
            $table->integer('friends_attendance_1d')->nullable()->default(0);
            $table->integer('total_attendance_1d')->nullable()->default(0);
            $table->integer('sibling_attendance_2d')->nullable()->default(0);
            $table->integer('friends_attendance_2d')->nullable()->default(0);
            $table->integer('total_attendance_2d')->nullable()->default(0);
            $table->integer('sibling_attendance_sd')->nullable()->default(0);
            $table->integer('friends_attendance_sd')->nullable()->default(0);
            $table->integer('total_attendance_sd')->nullable()->default(0);
            $table->integer('total_attendance_week')->nullable()->default(0);
            $table->foreignId('cell_id')->nullable()->constrained('cells');
            $table->foreignId('user_id')->nullable()->constrained('users');
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
        Schema::dropIfExists('church_attendances');
    }
};
