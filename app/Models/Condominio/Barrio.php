<?php

namespace App\Models\Condominio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barrio extends Model
{
    use HasFactory;

    protected $table = 'barrios';

    protected $fillable = [
        'id',
        'nombre',
        'condominio_id',
        'administrador_id',
    ];

    public function propiedades()
    {
        return $this->hasMany(Propiedad::class);
    }

    public function condominio()
    {
        return $this->belongsTo(Condominio::class);
    }

    public function administrador()
    {
        return $this->belongsTo(Administrador::class);
    }

}
