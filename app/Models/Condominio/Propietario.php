<?php

namespace App\Models\Condominio;

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

    public function condominios() {
        // return $this->hasManyThrough(Condominio::class, PropietarioCondominio::class);
        return $this->belongsToMany(Condominio::class, 'propietario_condominios', 'propietario_id', 'condominio_id');

    }

}
