<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosVisita extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'visita_id',
        'anamnesis',
        'exploracion',
        'peso',
        'altura',
        'BMI',
        'tension_alterial',
        'evolucion',
        'tratamiento'
    ];

    public function visita()
    {
        return $this->belongsTo(Visita::class);
    }
    
}
