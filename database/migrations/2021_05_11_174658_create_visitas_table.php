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
            $table->integer("paciente_id");
            $table->integer("calendario_id");
            $table->date('fecha');    
            $table->time('hora');               
            $table->integer('tipovisita_id');
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
            $table->integer('prueba_medica_id');            
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
