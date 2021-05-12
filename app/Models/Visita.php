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
        'tipo_visita_id',
        'comentarios',
        'observaciones',
        'paciente_id'
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
    public function datosVisita(){
        return $this->hasOne(DatosVisita::class);
    }
 
 

}
