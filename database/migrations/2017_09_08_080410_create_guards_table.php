<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('list_places'); // [{lat:x, long:y}, {lat:x, long:y}]
            $table->string('list_child_nbs'); // [1, 3]
            $table->string('list_range'); // [1, 3]
            $table->string('debut');
            $table->string('fin');
            $table->string('textbox');
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
        Schema::dropIfExists('guards');
    }
}
