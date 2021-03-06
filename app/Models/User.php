<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'avatar',
        'password_change_at'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role() {
        return $this->belongsTo(Role::class);
    }
    public function rolUsuario() {
       

        switch ($this->role->nombre_rol) {
            case 'administrador':
                return 'Administrador '. $this->name;
            case 'medico':
                return 'Doctor/a ' . $this->name;
            case 'paciente':
                return 'Paciente ' . $this->name;
            default:
                return $this->name;
        }
    
    }
    public function foto() {
        return $this->belongsTo('App\Models\Foto');
    }
    public function medico()
    {
        return $this->hasOne(Medico::class);
    }

    public function calendario(){
        return $this->hasMany(Calendario::class);
    }

    public function getAvatarUrl()
    {
        if ($this->avatar)
         return asset($this->avatar);

   
    }
}
