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
use App\Http\Controllers\Administracion\MenuItemsController;
use App\Http\Controllers\Visitas\VisitanteController;
use App\Http\Controllers\Visitas\VisitaController;
use App\Http\Controllers\Visitas\VisitaMotivosController;
use App\Http\Controllers\Generales\DeliveryController;
use App\Http\Controllers\Generales\ServicioGeneralController;

Route::group(['prefix' => 'v1/', 'middleware' => 'tokenAutentication'], function () {
    // Rutas CRUD para Administradores
    Route::post('/managers', [AdministradorController::class, 'store']);
    Route::get('/managers/list/{id}', [AdministradorController::class, 'index']);
    Route::get('/managers/{id}', [AdministradorController::class, 'show']);
    Route::put('/managers/{id}', [AdministradorController::class, 'update']);
    Route::delete('/managers/{id}', [AdministradorController::class, 'destroy']);

    // Rutas CRUD para Regiones
    Route::post('/regions', [RegionController::class, 'store']);
    Route::get('/regions/list/{id}', [RegionController::class, 'index']);
    Route::get('/regions/{id}', [RegionController::class, 'show']);
    Route::put('/regions/{id}', [RegionController::class, 'update']);
    Route::delete('/regions/{id}', [RegionController::class, 'destroy']);

    // Rutas CRUD para Comunas
    Route::post('/communes', [ComunaController::class, 'store']);
    Route::get('/communes/list/{id}', [ComunaController::class, 'index']);
    Route::get('/communes/{id}', [ComunaController::class, 'show']);
    Route::put('/communes/{id}/modify', [ComunaController::class, 'update']);
    Route::delete('/communes/{id}', [ComunaController::class, 'destroy']);

    // Rutas CRUD para TipoNivel
    Route::post('/levels', [NivelController::class, 'store']);
    Route::get('/levels/list/{id}', [NivelController::class, 'index']);
    Route::get('/levels/{id}', [NivelController::class, 'show']);
    Route::put('/levels/{id}', [NivelController::class, 'update']);
    Route::delete('/levels/{id}', [NivelController::class, 'destroy']);

    // Rutas CRUD para TipoNivel
    Route::post('/level-types', [TipoNivelController::class, 'store']);
    Route::get('/level-types/list/{id}', [TipoNivelController::class, 'index']);
    Route::get('/level-types/{id}', [TipoNivelController::class, 'show']);
    Route::put('/level-types/{id}', [TipoNivelController::class, 'update']);
    Route::delete('/level-types/{id}', [TipoNivelController::class, 'destroy']);

    // Rutas CRUD para Condominios
    Route::post('/condominiums', [CondominioController::class, 'store']);
    Route::get('/condominiums/list/{id}', [CondominioController::class, 'index']);
    Route::get('/condominiums/{id}', [CondominioController::class, 'show']);
    Route::put('/condominiums/{id}/modify', [CondominioController::class, 'update']);
    Route::delete('/condominiums/{id}', [CondominioController::class, 'destroy']);

    // Rutas CRUD para Propiedades
    Route::post('/properties', [PropiedadController::class, 'store']);
    Route::get('/properties/list/{id}', [PropiedadController::class, 'index']);
    Route::get('/properties/{id}', [PropiedadController::class, 'show']);
    Route::put('/properties/{id}/modify', [PropiedadController::class, 'update']);
    Route::delete('/properties/{id}', [PropiedadController::class, 'destroy']);

    // Rutas CRUD para PropietarioCondominios
    Route::post('/property-ownerships', [PropietarioCondominioController::class, 'store']);
    Route::get('/property-ownerships/list/{id}', [PropietarioCondominioController::class, 'index']);
    Route::get('/property-ownerships/{id}', [PropietarioCondominioController::class, 'show']);
    Route::put('/property-ownerships/{id}/modify', [PropietarioCondominioController::class, 'update']);
    Route::delete('/property-ownerships/{id}', [PropietarioCondominioController::class, 'destroy']);

    // Rutas CRUD para TipoPropiedad
    Route::post('/property-types', [TipoPropiedadController::class, 'store']);
    Route::get('/property-types/list/{id}', [TipoPropiedadController::class, 'index']);
    Route::get('/property-types/{id}', [TipoPropiedadController::class, 'show']);
    Route::put('/property-types/{id}/modify', [TipoPropiedadController::class, 'update']);
    Route::delete('/property-types/{id}', [TipoPropiedadController::class, 'destroy']);

    // Rutas CRUD para Propietarios
    Route::post('/owners', [PropietarioController::class, 'store']);
    Route::get('/owners/list/{condominio_id}', [PropietarioController::class, 'index']);
    Route::get('/owners/{id}', [PropietarioController::class, 'show']);
    Route::put('/owners/{id}', [PropietarioController::class, 'update']);
    Route::delete('/owners/{id}', [PropietarioController::class, 'destroy']);

    // Rutas CRUD para Barrios
    Route::post('/communities', [BarrioController::class, 'store']);
    Route::get('/communities/list/{id}', [BarrioController::class, 'index']);
    Route::get('/communities/{id}', [BarrioController::class, 'show']);
    Route::put('/communities/{id}', [BarrioController::class, 'update']);
    Route::delete('/communities/{id}', [BarrioController::class, 'destroy']);

    // Rutas CRUD para Barrios
    Route::post('/guests', [VisitaController::class, 'store']);
    Route::get('/guests/list/{id}', [VisitaController::class, 'index']);
    Route::get('/guests/{id}', [VisitaController::class, 'show']);
    Route::put('/guests/{id}', [VisitaController::class, 'update']);
    Route::delete('/guests/{id}', [VisitaController::class, 'destroy']);

    // Rutas CRUD para Barrios
    Route::post('/visitors', [VisitanteController::class, 'store']);
    Route::get('/visitors/list/{id}', [VisitanteController::class, 'index']);
    Route::get('/visitors/{id}', [VisitanteController::class, 'show']);
    Route::put('/visitors/{id}', [VisitanteController::class, 'update']);
    Route::delete('/visitors/{id}', [VisitanteController::class, 'destroy']);

    Route::get('/visit-reasons/list/{id}', [VisitaMotivosController::class, 'index']);
    Route::post('/visit-reasons', [VisitaMotivosController::class, 'store']);
    Route::get('/visit-reasons/{id}', [VisitaMotivosController::class, 'show']);
    Route::put('/visit-reasons/{id}', [VisitaMotivosController::class, 'update']);
    Route::delete('/visit-reasons/{id}', [VisitaMotivosController::class, 'destroy']);

    Route::get('/menu-items/{userId}', [MenuItemsController::class, 'show']);

    Route::get('/deliveries/list/{condominioId}', [DeliveryController::class, 'index']);
    Route::post('/deliveries', [DeliveryController::class, 'store']);

    Route::get('/generals-services/list/{condominioId}', [ServicioGeneralController::class, 'index']);
    Route::post('/generals-services', [ServicioGeneralController::class, 'store']);


});
