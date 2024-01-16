<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Condominio\Condominio;

class Comuna extends Model
{
    use HasFactory;

    protected $table = 'comunas';

    protected $fillable = [
        'id',
        'region_id',
        'nombre',
        'conara_sii',
        'codigo_tesoreria',
    ];


    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function condominios()
    {
        return $this->hasMany(Condominio::class);
    }

}
