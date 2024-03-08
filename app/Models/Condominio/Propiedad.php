<?php

namespace App\Models\Condominio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Visitas\Visita;

class Propiedad extends Model
{
    use HasFactory;

    protected $table = 'propiedades';

    protected $fillable = [
        'id',
        'nombre',
        'tipo_propiedad_id',
        'nivel_id',
        'propietario_id',
        'barrio_id',
    ];

    public function tipoPropiedad() {
        return $this->belongsTo(TipoPropiedad::class);
    }

    public function condominio() {
        return $this->belongsTo(Condominio::class);
    }

    public function nivel() {
        return $this->belongsTo(Nivel::class);
    }

    public function propietario() {
        return $this->belongsTo(Propietario::class);
    }

    public function barrio() {
        return $this->belongsTo(Barrio::class);
    }

    public function visitas() {
        return $this->hasMany(Visita::class);
    }

}
