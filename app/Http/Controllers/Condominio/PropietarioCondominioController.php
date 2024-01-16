<?php

namespace App\Http\Controllers\Condominio;

use Throwable;
use App\Models\Condominio\PropietarioCondominio;
use Illuminate\Http\Request;
use App\Constants\ErrorCodes;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;

class PropietarioCondominioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $propietarioCondominio = PropietarioCondominio::all();
            return $this->responseOK($propietarioCondominio);
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
            $propietarioCondominio = PropietarioCondominio::create($request->all());
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
            $propietarioCondominio = PropietarioCondominio::findOrFail($id);
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
            $propietarioCondominio = PropietarioCondominio::findOrFail($id);
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
            $propietarioCondominio = PropietarioCondominio::findOrFail($id);
            $propietarioCondominio->delete();
            return $this->responseOK($propietarioCondominio);
        } catch (ModelNotFoundException $e) {
            return $this->setResponseErr($e, Response::HTTP_NO_CONTENT);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }
    }
}
