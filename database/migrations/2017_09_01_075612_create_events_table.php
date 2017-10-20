<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom')->unique();
            $table->string('debut');
            $table->string('fin');
            $table->integer('lat');
            $table->integer('long');
            $table->string('place');
            $table->string('list_performs')->nullable();
            $table->string('billetterie')->nullable();
            $table->longText('textbox')->nullable();
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
        Schema::dropIfExists('events');
    }
}
