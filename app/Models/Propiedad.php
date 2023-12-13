<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propiedad extends Model
{
    use HasFactory;

    protected $table = 'propiedades';

    protected $fillable = [
        'id',
        'nombre',
        'tipo_propiedad_id',
        'condominio_id',
        'nivel_id',
        'propietario_id',
        'barrio_id',
    ];

}
