<?php

namespace App\Http\Controllers\Condominio;

use Throwable;
use App\Models\Condominio\TipoNivel;
use Illuminate\Http\Request;
use App\Constants\ErrorCodes;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class TipoNivelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        try {
            Log::debug("Consultando tipos de niveles para el condominio $id...");
            $tipoNiveles = TipoNivel::where('condominio_id', $id)
                        ->orderBy('nombre')
                        ->get();
            return $this->responseOK($tipoNiveles);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::LIST_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required',
                'habitacional' => 'required|boolean',
                'condominio_id' => 'required|exists:condominios,id',
                // Agrega aquí otras validaciones según tus campos
            ]);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }
        try {
            $tipoNivel = TipoNivel::create($request->all());
            return $this->responseOK($tipoNivel, Response::HTTP_CREATED);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::CREATE_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $tipoNivel = TipoNivel::findOrFail($id);
            return $this->responseOK($tipoNivel);
        } catch (ModelNotFoundException $e) {
            return $this->setResponseErr($e, Response::HTTP_NO_CONTENT);
        } catch (Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::SHOW_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required',
                'habitacional' => 'required|boolean',
                // Agrega aquí otras validaciones según tus campos
            ]);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }
        try {
            $tipoNivel = TipoNivel::findOrFail($id);
            $tipoNivel->update($request->all());
            return $this->responseOK($tipoNivel);
        } catch (Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::UPDATE_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $tipoNivel = TipoNivel::findOrFail($id);
            $tipoNivel->delete();
            return $this->responseOK($tipoNivel);
        } catch (ModelNotFoundException $e) {
            return $this->setResponseErr($e, Response::HTTP_NO_CONTENT);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }
    }
}
