<?php

namespace App\Models\Condominio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    use HasFactory;

    protected $table = 'administradores';

    protected $fillable = [
        'nombre',
        'paterno',
        'materno',
        'correo_electronico',
        'telefono',
        // Otros campos permitidos para asignación masiva
    ];

    public function condominios()
    {
        return $this->hasMany(Condominio::class);
    }

    public function barrios() {
        return $this->hasMany(Barrio::class);
    }

}
