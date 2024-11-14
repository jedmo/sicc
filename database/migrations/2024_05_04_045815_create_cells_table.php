
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
        Schema::create('cells', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('full_code');
            $table->enum('type', ['Adultos', 'Jóvenes', 'Niños']);
            $table->integer('day')->nullable();
            $table->time('hour', precision: 0)->nullable();
            $table->boolean('status');
            $table->string('temp_leader')->nullable();
            $table->foreignId('user_leader_id')->nullable()->constrained('users');
            $table->foreignId('leader_id')->nullable()->constrained('cell_members');
            $table->foreignId('host_id')->nullable()->constrained('cell_members');
            $table->foreignId('assistant_id')->nullable()->constrained('cell_members');
            $table->foreignId('address_id')->nullable()->constrained('addresses');
            $table->foreignId('sector_id')->constrained('sectors');
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
        Schema::dropIfExists('cells');
    }
};
