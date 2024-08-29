<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'primerNombre',
        'primerApellido',
        'email',
        'password',
        'estado',
    ];

    protected $hidden = [
        'password'
    ];

    // public function generateToken() {
    //     return 'pepe';
    // }

    public function generateToken() {
        $token = Str::random(64);
        // $this->tokens()->create(['token' => hash('sha256', $token)]);
        return $token;
    }

    // public function tokens(){
    //     return $this->hasMany(PersonalAccessToken::class);
    // }

}
