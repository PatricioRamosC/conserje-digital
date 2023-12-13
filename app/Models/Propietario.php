<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propietario extends Model
{
    use HasFactory;

    protected $table = 'propietarios';

    protected $fillable = [
        'id',
        'nombre',
        'paterno',
        'materno',
        'correo_electronico',
        'telefono',
        'fecha_nacimiento',
    ];

}
