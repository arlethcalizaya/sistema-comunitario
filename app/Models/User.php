<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// 1. AGREGA ESTA LÍNEA AQUÍ ARRIBA:
use Laravel\Sanctum\HasApiTokens; 

class User extends Authenticatable
{
    // 2. AGREGA "HasApiTokens" DENTRO DE ESTA LISTA:
    use HasApiTokens, HasFactory, Notifiable; 

    protected $fillable = [
        'name',
        'apellido',
        'email',
        'password',
        'telefono',
        'rol',
        'estado',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}