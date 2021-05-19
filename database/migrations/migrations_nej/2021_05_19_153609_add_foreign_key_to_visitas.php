<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToVisitas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visitas', function (Blueprint $table) {
            $table->foreign("paciente_id")->references('id')->on('pacientes')->onDelete('cascade');            
            $table->foreign("calendario_id")->references('id')->on('calendarios')->onDelete('cascade');  
            $table->foreign("motivo_visita_id")->references('id')->on('pacientes');            
            $table->foreign("tipo_visita_id")->references('id')->on('calendarios');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visitas', function (Blueprint $table) {
            //
        });
    }
}
