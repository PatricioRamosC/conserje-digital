<?php

namespace App\Http\Controllers\Visitas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visitas\VisitaMotivo;
use Throwable;
use App\Constants\ErrorCodes;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;

class VisitaMotivosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($condominio_id)
    {
        try {
            $visita = VisitaMotivo::where('condominio_id', $condominio_id)->get();
            return $this->responseOK($visita);
        } catch (ModelNotFoundException $e) {
            return $this->setResponseErr($e, Response::HTTP_NO_CONTENT);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre'        => 'required',
                'condominio_id' => 'required|exists:condominios,id',
                'delivery'      => 'required|boolean',
                'services'      => 'required|boolean',
                // Agrega otras validaciones según tus campos
            ]);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }
        try {
            $motivo = VisitaMotivo::create($request->all());
            return $this->responseOK($motivo);
        } catch (ModelNotFoundException $e) {
            return $this->setResponseErr($e, Response::HTTP_NO_CONTENT);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $motivo = VisitaMotivo::findOrFail($id);
            return $this->responseOK($motivo);
        } catch (ModelNotFoundException $e) {
            return $this->setResponseErr($e, Response::HTTP_NO_CONTENT);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'nombre'        => 'required',
                'condominio_id' => 'required|exists:condominios,id',
                'delivery'      => 'required|boolean',
                'services'      => 'required|boolean',
                // Agrega otras validaciones según tus campos
            ]);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }
        try {
            $motivo = VisitaMotivo::findOrFail($id);
            $motivo->update($request->all());
            return $this->responseOK($motivo);
        } catch (ModelNotFoundException $e) {
            return $this->setResponseErr($e, Response::HTTP_NO_CONTENT);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $motivo = VisitaMotivo::findOrFail($id);
            $motivo->delete();
            return $this->responseOK($motivo);
        } catch (ModelNotFoundException $e) {
            return $this->setResponseErr($e, Response::HTTP_NO_CONTENT);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }
    }
}
