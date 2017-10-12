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
            $table->string('list_places'); // [['lat'=>x, 'long'=>y, 'name'=>'name of the place'], ['lat'=>x, 'long'=>y, 'name'=>'name of the other place'],... ]
            $table->string('debut');
            $table->string('fin');
            $table->string('textbox');
            $table->string('list_procult')->nullable(); // [['name'=>'machin', 'id' => n], ['name'=>'autre', 'id' => n], ['name'=>'encore autre', 'id' => n]]
            $table->string('statut')->nullable();
            $table->string('concluding_procult')->nullable(); // ['name'=>'machin_conclu', 'id' => n]
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
