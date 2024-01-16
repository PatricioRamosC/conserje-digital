<?php

namespace App\Http\Controllers\Visitas;

use Throwable;
use App\Models\Visitas\Visitante;
use Illuminate\Http\Request;
use App\Constants\ErrorCodes;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;

class VisitanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($condominio_id)
    {
        try {
            $visitantes = Visitante::where('condominio_id', $condominio_id);
            return $this->responseOK($visitantes);
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
                'cedula_identidad'   => 'required',
                'nombre'             => 'required',
                'telefono'           => 'required',
                'correo'             => 'required|email',
                'foto'               => 'nullable',
                'firma'              => 'nullable',
                'condominio_id'      => 'required|exists:condominios,id',
                // Agrega otras validaciones según tus campos
            ]);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }

        try {
            $visitante = Visitante::create($request->all());
            return $this->responseOK($visitante, Response::HTTP_CREATED);
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
            $visitante = Visitante::findOrFail($id);
            return $this->responseOK($visitante);
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
                'cedula_identidad'   => 'required',
                'nombre'             => 'required',
                'telefono'           => 'required',
                'correo'             => 'required|email',
                'foto'               => 'nullable',
                'firma'              => 'nullable',
                'condominio_id'      => 'required',
                // Agrega otras validaciones según tus campos
            ]);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }

        try {
            $visitante = Visitante::findOrFail($id);
            $visitante->update($request->all());
            return $this->responseOK($visitante);
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
            $visitante = Visitante::findOrFail($id);
            $visitante->delete();
            return $this->responseOK($visitante);
        } catch (ModelNotFoundException $e) {
            return $this->setResponseErr($e, Response::HTTP_NO_CONTENT);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }
    }
}
