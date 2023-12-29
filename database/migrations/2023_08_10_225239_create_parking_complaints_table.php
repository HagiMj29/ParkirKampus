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
        Schema::create('parking_complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('slot_id');
            $table->text('description');
            $table->string('reply', 100)->nullable();
            $table->enum('status', ['Diproses', 'Selesai']);
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
        Schema::dropIfExists('parking_complaints');
    }
};
