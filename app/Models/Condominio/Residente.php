<?php

namespace App\Models\Condominio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residente extends Model
{
    use HasFactory;

    protected $table = 'residentes';
    protected $fillable = [
        'cedula_identidad',
        'nombre',
        'paterno',
        'materno',
        'telefono',
        'correo',
        'propiedad_id',
    ];

    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class);
    }

}
