<?php

use App\Enums\StepEnum;
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
        Schema::create('trackings', function (Blueprint $table) {
            $table->id();
            $table->enum('step', [StepEnum::CONVERSION->value, StepEnum::WATER_BAPTIZED->value, StepEnum::HOLY_SPIRIT_BAPTIZED->value, StepEnum::LEADER_ROUTE->value])->nullable();
            $table->date('step_date')->nullable();
            $table->string('location')->nullable();
            $table->string('comment')->nullable();
            $table->foreignId('member_id')->constrained('members');
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
        Schema::dropIfExists('trackings');
    }
};
