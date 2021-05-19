<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PruebaMedica extends Model
{
    use HasFactory;
    protected $fillable = [       
        'tipo_prueba_id',
        'visita_id',
        'valoracion',  
    ];
    public function visita(){
        return $this->belongsTo(Visita::class);
    }
    public function tipoPrueba()
    {
        return $this->belongsTo(TipoPrueba::class);

    }
}
