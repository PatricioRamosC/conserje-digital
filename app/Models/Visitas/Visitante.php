<?php

namespace App\Models\Visitas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitante extends Model
{
    use HasFactory;

    public function visitas() {
        return $this->hasMany(Visitante::class);
    }

}
