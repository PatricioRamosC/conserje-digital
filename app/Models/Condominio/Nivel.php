<?php

namespace App\Models\Condominio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    use HasFactory;

    protected $table = 'niveles';

    protected $fillable = [
        'id',
        'nombre',
        'nivel',
        'tipo_nivel_id',
    ];

    public function tipoNivel() {
        return $this->belongsTo(TipoNivel::class);
    }

    public function propiedades() {
        return $this->hasMany(Propiedad::class);
    }

    public function condominio() {
        return $this->belongsTo(Condominio::class);
    }

}
