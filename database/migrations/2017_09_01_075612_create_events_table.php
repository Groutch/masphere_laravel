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
            $table->integer('lat')->nullable();
            $table->integer('long')->nullable();
            $table->string('liste_groupes')->nullable();
            $table->string('stylemusical')->nullable();
            $table->string('billetterie')->nullable();
            $table->string('textbox')->nullable();
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
