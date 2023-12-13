<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropietarioCondominios extends Model
{
    use HasFactory;

    protected $table = 'propietario_condominios';

    protected $fillable = [
        'id',
        'propietario_id',
        'condominio_id',
    ];

}
