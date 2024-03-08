<?php

namespace App\Models\Condominio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropietarioCondominio extends Model
{
    use HasFactory;

    protected $table = 'propietario_condominios';

    protected $fillable = [
        'id',
        'propietario_id',
        'condominio_id',
    ];

}
