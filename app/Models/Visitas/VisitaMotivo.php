<?php

namespace App\Models\Visitas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Condominio\Condominio;

class VisitaMotivo extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'condominio_id', 'delivery', 'services'];

    public function condominio()
    {
        return $this->belongsTo(Condominio::class);
    }
}
