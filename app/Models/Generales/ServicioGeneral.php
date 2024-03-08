<?php

namespace App\Models\Generales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicioGeneral extends Model
{
    use HasFactory;
    protected $table = 'servicios_generales';
    protected $fillable = [
        'id',
        'condominio_id',
        'nombre',
    ];

}
