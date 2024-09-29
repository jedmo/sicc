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
        Schema::create('multiplications', function (Blueprint $table) {
            $table->id();
            $table->date('opening_date');
            $table->string('multiplication_type')->nullable();
            $table->integer('members_before')->nullable();
            $table->integer('members_after')->nullable();
            $table->integer('members_new_cell')->nullable();
            $table->string('mother_cell_code')->nullable();
            $table->foreignId('mother_cell_id')->nullable()->constrained('cells');
            $table->foreignId('new_cell_id')->constrained('cells');
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
        Schema::dropIfExists('multiplications');
    }
};
