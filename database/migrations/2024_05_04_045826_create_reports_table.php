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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('adult_sibling_attendance')->nullable()->default(0);
            $table->integer('adult_friends_attendance')->nullable()->default(0);
            $table->integer('total_adult_attendance')->nullable()->default(0);
            $table->integer('youth_sibling_attendance')->nullable()->default(0);
            $table->integer('youth_friends_attendance')->nullable()->default(0);
            $table->integer('total_youth_attendance')->nullable()->default(0);
            $table->integer('children_sibling_attendance')->nullable()->default(0);
            $table->integer('children_friends_attendance')->nullable()->default(0);
            $table->integer('total_children_attendance')->nullable()->default(0);
            $table->integer('total_attendance')->nullable()->default(0);
            $table->integer('conversions')->nullable()->default(0);
            $table->integer('reconciliations')->nullable()->default(0);
            $table->integer('programmed_visits')->nullable()->default(0);
            $table->integer('water_baptisms')->nullable()->default(0);
            $table->double('church_offering', 4, 2)->nullable()->default(0);
            $table->double('offering_meter_by_meter', 4, 2)->nullable()->default(0);
            $table->double('pro_bus_offering', 4, 2)->nullable()->default(0);
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('cell_id')->nullable()->constrained('cells');
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
        Schema::dropIfExists('reports');
    }
};
