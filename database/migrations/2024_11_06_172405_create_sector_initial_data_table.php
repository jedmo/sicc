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
        Schema::create('sector_initial_data', function (Blueprint $table) {
            $table->id();
            $table->date('initial_date');
            $table->integer('child_attendance')->nullable();
            $table->integer('young_attendance')->nullable();
            $table->integer('adult_attendance')->nullable();
            $table->integer('child_leader')->nullable();
            $table->integer('young_leader')->nullable();
            $table->integer('adult_leader')->nullable();
            $table->foreignId('sector_id')->nullable()->constrained('sectors');
            $table->foreignId('goal_id')->nullable()->constrained('goals');
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
        Schema::dropIfExists('sector_initial_data');
    }
};
