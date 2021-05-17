<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre_evento',
        'inicio',
        'fin',
        'duracion',
        'user_id',
        'visita_id'
     
    ];

    public function visita(){
        return $this->hasMany(Visita::Class);
    }

}
