<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group([
    //     'prefix' => 'v1/'
// ], function () {
    //     Route::get('/userV2', function() {
        //         Log::debug("message");
        //         return view('welcome');
//     });
// });

use App\Http\Controllers\Administracion\RegionController;
use App\Http\Controllers\Administracion\ComunaController;
use App\Http\Controllers\Condominio\AdministradorController;
use App\Http\Controllers\Condominio\BarrioController;
use App\Http\Controllers\Condominio\CondominioController;
use App\Http\Controllers\Condominio\TipoPropiedadController;
use App\Http\Controllers\Condominio\PropietarioController;
use App\Http\Controllers\Condominio\PropietarioCondominioController;
use App\Http\Controllers\Condominio\PropiedadController;
use App\Http\Controllers\Condominio\NivelController;
use App\Http\Controllers\Condominio\TipoNivelController;
use App\Http\Controllers\Visitas\VisitanteController;
use App\Http\Controllers\Visitas\VisitaController;

Route::group(['prefix' => 'v1/', 'middleware' => 'tokenAutentication'], function () {
    // Rutas CRUD para Administradores
    Route::post('/managers', [AdministradorController::class, 'store']);
    Route::get('/managers/list', [AdministradorController::class, 'index']);
    Route::get('/managers/{id}/details', [AdministradorController::class, 'show']);
    Route::put('/managers/{id}/modify', [AdministradorController::class, 'update']);
    Route::delete('/managers/{id}/remove', [AdministradorController::class, 'destroy']);

    // Rutas CRUD para Regiones
    Route::post('/regions', [RegionController::class, 'store']);
    Route::get('/regions/list', [RegionController::class, 'index']);
    Route::get('/regions/{id}/details', [RegionController::class, 'show']);
    Route::put('/regions/{id}/modify', [RegionController::class, 'update']);
    Route::delete('/regions/{id}/remove', [RegionController::class, 'destroy']);

    // Rutas CRUD para Comunas
    Route::post('/communes', [ComunaController::class, 'store']);
    Route::get('/communes/list', [ComunaController::class, 'index']);
    Route::get('/communes/{id}/details', [ComunaController::class, 'show']);
    Route::put('/communes/{id}/modify', [ComunaController::class, 'update']);
    Route::delete('/communes/{id}/remove', [ComunaController::class, 'destroy']);

    // Rutas CRUD para TipoNivel
    Route::post('/levels', [NivelController::class, 'store']);
    Route::get('/levels/list/{id}', [NivelController::class, 'index']);
    Route::get('/levels/{id}/details', [NivelController::class, 'show']);
    Route::put('/levels/{id}/modify', [NivelController::class, 'update']);
    Route::delete('/levels/{id}/remove', [NivelController::class, 'destroy']);

    // Rutas CRUD para TipoNivel
    Route::post('/level-types', [TipoNivelController::class, 'store']);
    Route::get('/level-types/list/{id}', [TipoNivelController::class, 'index']);
    Route::get('/level-types/{id}/details', [TipoNivelController::class, 'show']);
    Route::put('/level-types/{id}/modify', [TipoNivelController::class, 'update']);
    Route::delete('/level-types/{id}/remove', [TipoNivelController::class, 'destroy']);

    // Rutas CRUD para Condominios
    Route::post('/condominiums', [CondominioController::class, 'store']);
    Route::get('/condominiums/list', [CondominioController::class, 'index']);
    Route::get('/condominiums/{id}/details', [CondominioController::class, 'show']);
    Route::put('/condominiums/{id}/modify', [CondominioController::class, 'update']);
    Route::delete('/condominiums/{id}/remove', [CondominioController::class, 'destroy']);

    // Rutas CRUD para Propiedades
    Route::post('/properties', [PropiedadController::class, 'store']);
    Route::get('/properties/list/{id}', [PropiedadController::class, 'index']);
    Route::get('/properties/{id}/details', [PropiedadController::class, 'show']);
    Route::put('/properties/{id}/modify', [PropiedadController::class, 'update']);
    Route::delete('/properties/{id}/remove', [PropiedadController::class, 'destroy']);

    // Rutas CRUD para PropietarioCondominios
    Route::post('/property-ownerships', [PropietarioCondominioController::class, 'store']);
    Route::get('/property-ownerships/list', [PropietarioCondominioController::class, 'index']);
    Route::get('/property-ownerships/{id}/details', [PropietarioCondominioController::class, 'show']);
    Route::put('/property-ownerships/{id}/modify', [PropietarioCondominioController::class, 'update']);
    Route::delete('/property-ownerships/{id}/remove', [PropietarioCondominioController::class, 'destroy']);

    // Rutas CRUD para TipoPropiedad
    Route::post('/property-types', [TipoPropiedadController::class, 'store']);
    Route::get('/property-types/list', [TipoPropiedadController::class, 'index']);
    Route::get('/property-types/{id}/details', [TipoPropiedadController::class, 'show']);
    Route::put('/property-types/{id}/modify', [TipoPropiedadController::class, 'update']);
    Route::delete('/property-types/{id}/remove', [TipoPropiedadController::class, 'destroy']);

    // Rutas CRUD para Propietarios
    Route::post('/owners', [PropietarioController::class, 'store']);
    Route::get('/owners/list/{condominio_id}', [PropietarioController::class, 'index']);
    Route::get('/owners/{id}/details', [PropietarioController::class, 'show']);
    Route::put('/owners/{id}/modify', [PropietarioController::class, 'update']);
    Route::delete('/owners/{id}/remove', [PropietarioController::class, 'destroy']);

    // Rutas CRUD para Barrios
    Route::post('/communities', [BarrioController::class, 'store']);
    Route::get('/communities/list/{id}', [BarrioController::class, 'index']);
    Route::get('/communities/{id}/details', [BarrioController::class, 'show']);
    Route::put('/communities/{id}/modify', [BarrioController::class, 'update']);
    Route::delete('/communities/{id}/remove', [BarrioController::class, 'destroy']);

    // Rutas CRUD para Barrios
    Route::post('/guests', [VisitaController::class, 'store']);
    Route::get('/guests/list/{id}', [VisitaController::class, 'index']);
    Route::get('/guests/{id}/details', [VisitaController::class, 'show']);
    Route::put('/guests/{id}/modify', [VisitaController::class, 'update']);
    Route::delete('/guests/{id}/remove', [VisitaController::class, 'destroy']);

    // Rutas CRUD para Barrios
    Route::post('/visitors', [VisitanteController::class, 'store']);
    Route::get('/visitors/list/{id}', [VisitanteController::class, 'index']);
    Route::get('/visitors/{id}/details', [VisitanteController::class, 'show']);
    Route::put('/visitors/{id}/modify', [VisitanteController::class, 'update']);
    Route::delete('/visitors/{id}/remove', [VisitanteController::class, 'destroy']);

});
