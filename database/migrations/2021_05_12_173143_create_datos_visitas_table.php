<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosVisitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_visitas', function (Blueprint $table) {
            $table->id();
            $table->integer('visita_id');
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
        Schema::dropIfExists('datos_visitas');
    }
}
