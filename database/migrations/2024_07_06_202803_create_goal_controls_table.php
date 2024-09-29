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
        Schema::create('goal_controls', function (Blueprint $table) {
            $table->id();
            $table->integer('initial_members');
            $table->integer('leader')->nullable();
            $table->integer('assistance')->nullable();
            $table->integer('conversions')->nullable();
            $table->integer('baptisms')->nullable();
            $table->integer('programmed_visits')->nullable();
            $table->double('offerings')->nullable();
            $table->foreignId('cell_id')->constrained('cells');
            $table->foreignId('goal_id')->constrained('goals');
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
        Schema::dropIfExists('goal_controls');
    }
};
