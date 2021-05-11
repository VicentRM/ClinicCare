<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $fillable = [
        'nombre',
        'apellidos',
        'NIF',
        'fecha_nacimiento',
        'fecha_alta',
        'NHC',
        'sexo',
        'direccion',
        'CP',
        'poblacion',
        'telefono1',
        'telefono2',
        'email'

    ];
    use HasFactory;

    public function medicos() {
        return $this->belongsToMany(Medico::class);
    }
    public function visitas(){
        return $this->hasMany(Visita::class);
      
    }
}
