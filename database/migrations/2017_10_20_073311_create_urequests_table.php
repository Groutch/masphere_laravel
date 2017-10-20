<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urequests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('place');
            $table->string('lat');
            $table->string('long');
            $table->string('debut');
            $table->string('fin');
            $table->longText('textbox');
            $table->string('statut')->nullable();
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
        Schema::dropIfExists('urequests');
    }
}
