<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPrueba extends Model
{
    use HasFactory;
    public function pruebasMedicas(){
        return $this->hasMany(PruebaMedica::class);
    }
}
