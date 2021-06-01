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
            $table->unsignedBigInteger('motivo_visita_id')->nullable();
            $table->text('comentarios')->nullable();
            $table->text('observaciones')->nullable();
            $table->text('anamnesis')->nullable();
            $table->text('exploracion')->nullable();
            $table->double('peso')->nullable();
            $table->double('altura')->nullable();
            $table->double('IMC')->nullable();
            $table->double('tension_alterial')->nullable();
            $table->text('evolucion')->nullable();
            $table->text('tratamiento')->nullable();                  
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
