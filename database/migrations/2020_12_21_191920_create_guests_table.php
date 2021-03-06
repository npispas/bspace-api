<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->default(uniqid('', false));
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email');
            $table->string('nationality')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('status')->default('Pending');
            $table->timestamps();

            $table->unsignedBigInteger('reservation_id');
            $table->foreign('reservation_id')
                ->references('id')
                ->on('reservations')
                ->onDelete('Cascade');

            $table->unsignedBigInteger('room_stay_id');
            $table->foreign('room_stay_id')
                ->references('id')
                ->on('room_stays')
                ->onDelete('Cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guests');
    }
}
