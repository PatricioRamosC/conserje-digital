<?php

namespace App\Http\Controllers\Condominio;

use Throwable;
use App\Models\Condominio\Condominio;
use Illuminate\Http\Request;
use App\Constants\ErrorCodes;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;

class CondominioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // $condominios = Condominio::all();
            $condominios = Condominio::with('administrador', 'comuna.region')
                        ->orderBy('nombre', 'asc')
                        ->paginate(env('PAGINATE_CONDOMINIOS', env('PAGINATE', 50)));
            return $this->responseOK($condominios);
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
                'nombre'            => 'required',
                'direccion'         => 'required',
                'numero'            => 'required',
                'codigo_postal'     => 'required',
                'comuna_id'         => 'required|exists:comunas,id',
                'administrador_id'  => 'required|exists:administradores,id',
            ]);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }
        try {
            $condominio = Condominio::create($request->all());
            return $this->responseOK($condominio, Response::HTTP_CREATED);
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
            $condominio = Condominio::findOrFail($id);
            return $this->responseOK($condominio);
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
                'nombre'            => 'required',
                'direccion'         => 'required',
                'numero'            => 'required',
                'codigo_postal'     => 'required',
                'comuna_id'         => 'required|exists:comunas,id',
                'administrador_id'  => 'required|exists:administradores,id',
            ]);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }
        try {
            $condominio = Condominio::findOrFail($id);
            $condominio->update($request->all());
            return $this->responseOK($condominio);
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
            $condominio = Condominio::findOrFail($id);
            $condominio->delete();
            return $this->responseOK($condominio);
        } catch (ModelNotFoundException $e) {
            return $this->setResponseErr($e, Response::HTTP_NO_CONTENT);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }
    }
}
