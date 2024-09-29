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
        Schema::create('supervision_attendances', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('attendance')->nullable();
            $table->longText('member_attendance')->nullable();
            $table->foreignId('sector_id')->constrained('sectors');
            $table->foreignId('zone_id')->constrained('zones');
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
        Schema::dropIfExists('supervision_attendances');
    }
};
