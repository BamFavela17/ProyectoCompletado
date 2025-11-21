<?php

namespace App\Models;

// Importamos la interfaz necesaria para la autenticación
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Database\Eloquent\Factories\HasFactory;

class usuarios extends Authenticatable 
{
    use HasFactory;
    
    protected $table = 'usuarios'; 

    protected $fillable = [
        'user_name', 
        'user_pass', 
        'user_type',
    ];
     
    protected $hidden = [
        'user_pass', 
    ];

    public $timestamps = false;
    
    public function getAuthPassword()
    {
        return $this->user_pass;
    }
}