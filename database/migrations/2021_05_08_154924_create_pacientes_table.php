<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',100);
            $table->string('apellidos',100);
            $table->string('NIF',10);
            $table->date('fecha_nacimiento');
            $table->date('fecha_alta');
            $table->string('NHC',100);
            $table->string('sexo',100);
            $table->string('direccion',100);
            $table->string('CP',100);
            $table->string('telefono1',100);
            $table->string('telefono2',100);
            $table->string('email',100);                     
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
        Schema::dropIfExists('pacientes');
    }
}
