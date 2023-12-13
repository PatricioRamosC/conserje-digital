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

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\CondominioController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ComunaController;
use App\Http\Controllers\TipoPropiedadController;
use App\Http\Controllers\PropietarioController;
use App\Http\Controllers\PropietarioCondominiosController;
use App\Http\Controllers\PropiedadController;
use App\Http\Controllers\NivelController;

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
    Route::post('/level-types', [NivelController::class, 'store']);
    Route::get('/level-types/list', [NivelController::class, 'index']);
    Route::get('/level-types/{id}/details', [NivelController::class, 'show']);
    Route::put('/level-types/{id}/modify', [NivelController::class, 'update']);
    Route::delete('/level-types/{id}/remove', [NivelController::class, 'destroy']);

    // Rutas CRUD para Condominios
    Route::post('/condominiums', [CondominioController::class, 'store']);
    Route::get('/condominiums/list', [CondominioController::class, 'index']);
    Route::get('/condominiums/{id}/details', [CondominioController::class, 'show']);
    Route::put('/condominiums/{id}/modify', [CondominioController::class, 'update']);
    Route::delete('/condominiums/{id}/remove', [CondominioController::class, 'destroy']);

    // Rutas CRUD para Propiedades
    Route::post('/properties', [PropiedadController::class, 'store']);
    Route::get('/properties/list', [PropiedadController::class, 'index']);
    Route::get('/properties/{id}/details', [PropiedadController::class, 'show']);
    Route::put('/properties/{id}/modify', [PropiedadController::class, 'update']);
    Route::delete('/properties/{id}/remove', [PropiedadController::class, 'destroy']);

    // Rutas CRUD para PropietarioCondominios
    Route::post('/property-ownerships', [PropietarioCondominiosController::class, 'store']);
    Route::get('/property-ownerships/list', [PropietarioCondominiosController::class, 'index']);
    Route::get('/property-ownerships/{id}/details', [PropietarioCondominiosController::class, 'show']);
    Route::put('/property-ownerships/{id}/modify', [PropietarioCondominiosController::class, 'update']);
    Route::delete('/property-ownerships/{id}/remove', [PropietarioCondominiosController::class, 'destroy']);

    // Rutas CRUD para TipoPropiedad
    Route::post('/property-types', [TipoPropiedadController::class, 'store']);
    Route::get('/property-types/list', [TipoPropiedadController::class, 'index']);
    Route::get('/property-types/{id}/details', [TipoPropiedadController::class, 'show']);
    Route::put('/property-types/{id}/modify', [TipoPropiedadController::class, 'update']);
    Route::delete('/property-types/{id}/remove', [TipoPropiedadController::class, 'destroy']);

    // Rutas CRUD para Propietarios
    Route::post('/owners', [PropietarioController::class, 'store']);
    Route::get('/owners/list', [PropietarioController::class, 'index']);
    Route::get('/owners/{id}/details', [PropietarioController::class, 'show']);
    Route::put('/owners/{id}/modify', [PropietarioController::class, 'update']);
    Route::delete('/owners/{id}/remove', [PropietarioController::class, 'destroy']);

});


// Route::group([
//     'prefix' => 'v1/'
// ], function () {
//     Route::group([
//         'middleware' => 'tokenAutentication'
//     ], function() {
//         Route::get('/list-user', [AuthController::class, 'recoverPassword']);

//         // Route::get('/user', function() {
//         //     return view('welcome');
//         // });
//     });
// });
