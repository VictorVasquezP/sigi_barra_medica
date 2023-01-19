<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('patient', 80);
            $table->string('address',120);
            $table->timestamp('date_admission');
            $table->timestamp('date_agress')->nullable();
            $table->string('diagnostic');
            $table->string('doctor',80);
            $table->string('nurse',80);
            $table->string('doctor_shift',80)->nullable();
            $table->string('type',20);
            $table->integer('status_id');
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
        Schema::dropIfExists('commands');
    }
}
