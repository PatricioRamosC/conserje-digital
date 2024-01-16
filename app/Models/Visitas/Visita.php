<?php

namespace App\Models\Visitas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Condominio\Propiedad;

class Visita extends Model
{
    use HasFactory;

    public function propiedad() {
        return $this->belongsTo(Propiedad::class);
    }

    public function visitante() {
        return $this->belongsTo(Visitante::class);
    }

}
