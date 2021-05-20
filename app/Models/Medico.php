<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;
    protected $fillable = [
        'NIF',
        'nombre',
        'apellidos',
        'num_colegiado',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function pacientes() {
        return $this->belongsToMany(Paciente::class);
    }
}
