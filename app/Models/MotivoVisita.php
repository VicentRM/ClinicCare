<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotivoVisita extends Model
{
    use HasFactory;
    public function visitas(){
        return $this->hasMany(Visita::class);
    }
}
