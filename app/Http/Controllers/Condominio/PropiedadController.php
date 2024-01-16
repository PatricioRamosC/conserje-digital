<?php

namespace App\Http\Controllers\Condominio;

use Throwable;
use App\Models\Condominio\Propiedad;
use Illuminate\Http\Request;
use App\Constants\ErrorCodes;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;

class PropiedadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        try {
            $propiedades = Propiedad::with([
                        'tipoPropiedad',
                        'condominio',
                        'nivel',
                        'propietario',
                        'barrio'
                    ])
                    ->where('condominio_id', $id)
                    ->orderBy()
                    ->paginate(env('PAGINATE_PROPIEDADES', env('PAGINATE', 50)));
            return $this->responseOK($propiedades);
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
                'tipo_propiedad_id' => 'required|exists:tipo_propiedades,id',
                'condominio_id'     => 'required|exists:condominios,id',
                'nivel_id'          => 'required|exists:niveles,id',
                'propietario_id'    => 'required|exists:propietarios,id',
                'barrio_id'         => 'required|exists:barrios,id',
                // Agrega otras validaciones según tus campos
            ]);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }

        try {
            $propiedad = Propiedad::create($request->all());
            return $this->responseOK($propiedad, Response::HTTP_CREATED);
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
            $propiedad = Propiedad::findOrFail($id);
            return $this->responseOK($propiedad);
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
                'tipo_propiedad_id' => 'required|exists:tipo_propiedades,id',
                'condominio_id'     => 'required|exists:condominios,id',
                'nivel_id'          => 'required|exists:niveles,id',
                'propietario_id'    => 'required|exists:propietarios,id',
                'barrio_id'         => 'required|exists:barrios,id',
                // Agrega otras validaciones según tus campos
            ]);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }

        try {
            $propiedad = Propiedad::findOrFail($id);
            $propiedad->update($request->all());
            return $this->responseOK($propiedad);
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
            $propiedad = Propiedad::findOrFail($id);
            $propiedad->delete();
            return $this->responseOK($propiedad);
        } catch (ModelNotFoundException $e) {
            return $this->setResponseErr($e, Response::HTTP_NO_CONTENT);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }
    }
}
