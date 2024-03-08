<?php

namespace App\Models\Condominio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoNivel extends Model
{
    use HasFactory;

    protected $table = 'tipo_niveles';

    protected $fillable = [
        'id',
        'nombre',
        'habitacional',
        'condominio_id',
    ];

    public function niveles() {
        return $this->hasMany(Nivel::class);
    }

    public function condominio() {
        return $this->belongsTo(Condominio::class);
    }

}
