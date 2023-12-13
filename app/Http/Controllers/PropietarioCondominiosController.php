<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\PropietarioCondominios;
use Illuminate\Http\Request;
use App\Constants\ErrorCodes;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PropietarioCondominiosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $propietarioCondominios = PropietarioCondominios::all();
            return $this->responseOK($propietarioCondominios);
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
                'propietario_id' => 'required|exists:propietarios,id',
                'condominio_id'  => 'required|exists:condominios,id',
                // Agrega otras validaciones según tus campos
            ]);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }

        try {
            $propietarioCondominio = PropietarioCondominios::create($request->all());
            return $this->responseOK($propietarioCondominio, Response::HTTP_CREATED);
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
            $propietarioCondominio = PropietarioCondominios::findOrFail($id);
            return $this->responseOK($propietarioCondominio);
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
                'propietario_id' => 'required|exists:propietarios,id',
                'condominio_id'  => 'required|exists:condominios,id',
                // Agrega otras validaciones según tus campos
            ]);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }

        try {
            $propietarioCondominio = PropietarioCondominios::findOrFail($id);
            $propietarioCondominio->update($request->all());
            return $this->responseOK($propietarioCondominio);
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
            $propietarioCondominio = PropietarioCondominios::findOrFail($id);
            $propietarioCondominio->delete();
            return $this->responseOK($propietarioCondominio);
        } catch (ModelNotFoundException $e) {
            return $this->setResponseErr($e, Response::HTTP_NO_CONTENT);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }
    }
}
