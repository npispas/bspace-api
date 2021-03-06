<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->string('name', 100);
            $table->string('description', 191);
            $table->integer('interior_size');
            $table->date('available_from');
            $table->date('available_to');
            $table->unsignedSmallInteger('max_occupancy');
            $table->unsignedSmallInteger('min_occupancy');
            $table->boolean('is_published');
            $table->string('location', 100);
            $table->timestamps();

            $table->unsignedBigInteger('room_type_id');
            $table->foreign('room_type_id')->references('id')->on('room_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
