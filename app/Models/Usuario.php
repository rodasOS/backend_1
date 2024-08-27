<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = [
        'primerNombre',
        'primerApellido',
        'correo',
        'password',
        'estado',
    ];

    protected $hidden = [
        'password'
    ];
}
