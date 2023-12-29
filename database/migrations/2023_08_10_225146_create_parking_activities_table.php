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
        Schema::create('parking_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('slot_id');
            $table->string('vehicle_number');
            $table->string('vehicle_brand');
            $table->dateTime('in_datetime', $precision = 0);
            $table->dateTime('out_datetime', $precision = 0)->nullable();
            $table->enum('status', ['Masuk', 'Keluar']);
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
        Schema::dropIfExists('parking_activities');
    }
};
