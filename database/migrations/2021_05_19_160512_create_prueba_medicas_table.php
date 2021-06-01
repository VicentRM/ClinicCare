<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePruebaMedicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prueba_medicas', function (Blueprint $table) {
            $table->id();     
            $table->unsignedBigInteger("tipo_prueba_id");  
            $table->unsignedBigInteger("visita_id");   
            $table->text('valoracion')->nullable();
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
        Schema::dropIfExists('prueba_medicas');
    }
}
