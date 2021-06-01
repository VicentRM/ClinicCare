<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documentos', function (Blueprint $table) {
            $table->foreign("paciente_id")->references('id')->on('pacientes')->onDelete('cascade');
            $table->foreign("visita_id")->references('id')->on('visitas')->onDelete('cascade');
            $table->foreign("prueba_medica_id")->references('id')->on('prueba_medicas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documentos', function (Blueprint $table) {
            $table->dropForeign("paciente_id");
            $table->dropForeign("visita_id");
            $table->dropForeign("prueba_medica_id");
        });
    }
}
