<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $region = new Region();
        $region->nombre = addslashes("Arica y Parinacota");
        $region->orden = 15;
        $region->save();

        $region = new Region();
        $region->nombre = addslashes("Tarapacá");
        $region->orden = 1;
        $region->save();

        $region = new Region();
        $region->nombre = addslashes("Antofagasta");
        $region->orden = 2;
        $region->save();

        $region = new Region();
        $region->nombre = addslashes("Atacama");
        $region->orden = 3;
        $region->save();

        $region = new Region();
        $region->nombre = addslashes("Coquimbo");
        $region->orden = 4;
        $region->save();

        $region = new Region();
        $region->nombre = addslashes("Valparaíso");
        $region->orden = 5;
        $region->save();

        $region = new Region();
        $region->nombre = addslashes("Metropolitana");
        $region->orden = 13;
        $region->save();

        $region = new Region();
        $region->nombre = addslashes("Libertador General Bernardo O'Higgins");
        $region->orden = 6;
        $region->save();

        $region = new Region();
        $region->nombre = addslashes("Maule");
        $region->orden = 7;
        $region->save();

        $region = new Region();
        $region->nombre = addslashes("Ñuble");
        $region->orden = 16;
        $region->save();

        $region = new Region();
        $region->nombre = addslashes("Biobío");
        $region->orden = 8;
        $region->save();

        $region = new Region();
        $region->nombre = addslashes("La Araucanía");
        $region->orden = 9;
        $region->save();

        $region = new Region();
        $region->nombre = addslashes("Los Ríos");
        $region->orden = 14;
        $region->save();

        $region = new Region();
        $region->nombre = addslashes("Los Lagos");
        $region->orden = 10;
        $region->save();

        $region = new Region();
        $region->nombre = addslashes("Aysén del General Carlos Ibáñez del Campo");
        $region->orden = 11;
        $region->save();

        $region = new Region();
        $region->nombre = addslashes("Magallanes y de la Antártica Chilena");
        $region->orden = 12;
        $region->save();
    }
}
