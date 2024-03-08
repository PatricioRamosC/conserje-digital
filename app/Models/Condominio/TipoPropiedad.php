<?php

namespace App\Models\Condominio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPropiedad extends Model
{
    use HasFactory;

    protected $table = 'tipo_propiedades';

    protected $fillable = [
        'id',
        'nombre',
        'condominio_id',
    ];

    public function propiedades() {
        return $this->hasMany(Propiedad::class);
    }

}
