<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Encryptable;
class Visita extends Model
{
    use HasFactory;
    use Encryptable;
    protected $encryptable  = [
        'comentarios',
        'observaciones',        
        'anamnesis',
        'exploracion',        
        'evolucion',
        'tratamiento'  

    ];
    protected $fillable = [       
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
 
    public function documentos(){
        return $this->hasMany(Documento::class);
    }

    public function pruebasMedicas(){
        return $this->hasMany(PruebaMedica::class);
    }
 

}
