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
            $table->string('nombre',250);
            $table->string('apellidos',250);
            $table->string('NIF',250)->unique();
            $table->date('fecha_nacimiento');
            $table->date('fecha_alta');
            $table->string('NHC',100);
            $table->string('sexo',100)->nullable();
            $table->string('direccion',100)->nullable();
            $table->string('CP',100);
            $table->string('poblacion',100)->nullable();
            $table->string('telefono1',100);
            $table->string('telefono2',100)->nullable();
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
