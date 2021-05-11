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
        'tipovisita_id',
        'comentarios',
        'observaciones',
        'paciente_id'
    ];

}
