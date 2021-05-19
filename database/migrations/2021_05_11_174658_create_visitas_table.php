<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("paciente_id");            
            $table->unsignedBigInteger("calendario_id");                  
            $table->unsignedBigInteger('tipo_visita_id');
            $table->unsignedBigInteger('motivo_visita_id');
            $table->text('comentarios');
            $table->text('observaciones');
            $table->text('anamnesis');
            $table->text('exploracion');
            $table->double('peso');
            $table->double('altura');
            $table->double('IMC');
            $table->double('tension_alterial');
            $table->text('evolucion');
            $table->text('tratamiento');                  
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
        Schema::dropIfExists('visitas');
    }
}
