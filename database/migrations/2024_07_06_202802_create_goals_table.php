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
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->date('start_period');
            $table->date('end_period');
            $table->integer('years');
            $table->integer('leader')->nullable();
            $table->integer('assistance')->nullable();
            $table->integer('conversions')->nullable();
            $table->integer('baptisms')->nullable();
            $table->integer('programmed_visits')->nullable();
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
        Schema::dropIfExists('goals');
    }
};
