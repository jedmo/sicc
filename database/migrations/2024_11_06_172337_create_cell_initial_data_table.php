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
        Schema::create('cell_initial_data', function (Blueprint $table) {
            $table->id();
            $table->date('initial_date');
            $table->integer('child_attendance')->nullable();
            $table->integer('young_attendance')->nullable();
            $table->integer('adult_attendance')->nullable();
            $table->foreignId('cell_id')->nullable()->constrained('cells');
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
        Schema::dropIfExists('cell_initial_data');
    }
};
