<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    use HasFactory;
    protected $fillable = [        
        'fecha',
        'hora',
        'paciente_id',
        'tipo_visita_id',
        'motivo_visita_id',
        'comentarios',
        'observaciones',
        'paciente_id',
        'anamnesis',
        'exploracion',
        'peso',
        'altura',
        'IMC',
        'tension_arterial',
        'evolucion',
        'tratamiento',
        'prueba_medica_id',
    ];

    public function tipoVisita()
    {
        return $this->belongsTo(TipoVisita::class);

    }
    public function motivoVisita()
    {
        return $this->belongsTo(MotivoVisita::class);

    }
    public function paciente(){

        return $this->belongsTo(Paciente::class);

    }
    public function calendario(){
        return $this->belongsTo(Calendario::Class);
    }
 
 
 

}
