<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignkeyToPruebaMedicas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prueba_medicas', function (Blueprint $table) {
            $table->foreign("visita_id")->references('id')->on('visitas')->onDelete('cascade');  
            $table->foreign("tipo_prueba_id")->references('id')->on('tipo_pruebas');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prueba_medicas', function (Blueprint $table) {
            //
        });
    }
}
