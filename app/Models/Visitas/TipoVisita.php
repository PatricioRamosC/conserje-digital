<?php

namespace App\Models\Visitas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoVisita extends Model
{
    use HasFactory;

    protected $fillable = [
        'condominio_id',
        'descripcion',
    ];

}
