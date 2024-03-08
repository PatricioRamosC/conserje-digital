<?php

namespace App\Models\Visitas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Condominio\Propiedad;

class Visita extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_inicio',
        'fecha_fin',
        'visita_motivo_id',
        'visitante_id',
        'propiedad_id',
        'tipo_visita_id',
    ];

    public function propiedad() {
        return $this->belongsTo(Propiedad::class);
    }

    public function visitante() {
        return $this->belongsTo(Visitante::class);
    }

    public function tipoVisita() {
        return $this->belongsTo(TipoVisita::class);
    }

}
