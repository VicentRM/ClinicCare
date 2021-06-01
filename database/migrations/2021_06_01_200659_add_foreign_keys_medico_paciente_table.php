<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysMedicoPacienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medico_paciente', function (Blueprint $table) {
            $table->foreign("paciente_id")->references('id')->on('pacientes')->onDelete('cascade');    
            $table->foreign("medico_id")->references('id')->on('medicos')->onDelete('cascade');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medico_paciente', function (Blueprint $table) {
            $table->dropForeign("paciente_id");
            $table->dropForeign("medico_id");
        });
    }
}
