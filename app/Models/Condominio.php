<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condominio extends Model
{
    use HasFactory;

    protected $table = 'condominios';

    protected $fillable = [
        'id',
        'nombre',
        'direccion',
        'numero',
        'codigo_postal',
        'comuna_id',
        'administrador_id',
        // Otros campos permitidos para asignación masiva
    ];

    public function administrador()
    {
        return $this->belongsTo(Administrador::class);
    }

    public function comuna()
    {
        return $this->belongsTo(Comuna::class);
    }

}
