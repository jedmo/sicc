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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyText('type');
            $table->date('start_date');
            $table->date('end_date');
            $table->tinyInteger('status');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('place')->nullable();
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('zone_id')->nullable()->constrained('zones');
            $table->foreignId('district_id')->nullable()->constrained('districts');
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
        Schema::dropIfExists('events');
    }
};
