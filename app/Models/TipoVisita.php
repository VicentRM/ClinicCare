<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoVisita extends Model
{
    use HasFactory;
    public function visitas(){
        return $this->hasMany(Visita::class);
    }
}
