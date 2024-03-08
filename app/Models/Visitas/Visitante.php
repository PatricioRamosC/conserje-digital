<?php

namespace App\Models\Visitas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitante extends Model
{
    use HasFactory;
    protected $fillable = [
        'cedula_identidad', 'nombre', 'telefono', 'correo', 'foto', 'firma', 'condominio_id',
    ];

    public function visitas() {
        return $this->hasMany(Visita::class);
    }

}
