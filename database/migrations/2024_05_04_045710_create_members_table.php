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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('second_name')->nullable();
            $table->string('third_name')->nullable();
            $table->string('first_surname');
            $table->string('second_surname')->nullable();
            $table->string('third_surname')->nullable();
            $table->string('sex')->nullable();
            $table->date('birth_date')->nullable();
            $table->integer('marital_status')->nullable();
            $table->string('nationality')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('blood_type')->nullable();
            $table->string('occupation')->nullable();
            $table->string('dui')->nullable();
            $table->string('nit')->nullable();
            $table->string('photo')->nullable();
            $table->date('conversion_date')->nullable();
            $table->boolean('status')->nullable();
            $table->foreignId('address_id')->nullable()->constrained('addresses');
            $table->foreignId('profile_type_id')->nullable()->constrained('profiles_type');
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
        Schema::dropIfExists('members');
    }
};
