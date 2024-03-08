<?php

namespace App\Http\Controllers\Condominio;

use Throwable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Condominio\Residente;
use App\Constants\ErrorCodes;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ResidenteController extends Controller
{
    /**
     * Listar los residentes de la propiedad.
     */
    public function index($propiedad_id)
    {
        try {
            $residentes = Residente::where('propiedad_id', $propiedad_id)
                    ->get();
            return $this->responseOK($residentes);
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
                'cedula_identidad'  => 'required',
                'nombre'            => 'required',
                'paterno'           => 'required',
                'materno'           => 'required',
                'telefono'          => 'required',
                'correo'            => 'required|email',
                'propiedad_id'      => 'exists|propiedad:id',
            ]);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }

        try {
            DB::beginTransaction();
            $propietario = Residente::create($request->all());
            foreach($request['condominios'] as $condominio) {
                $propietario_condominio = PropietarioCondominio::create([
                    'propietario_id' => $propietario->id,
                    'condominio_id' => $condominio,
                ]);
            }
            DB::commit();
            Log::debug('Residente creado satisfactoriamente ' . json_encode($propietario));
            return $this->responseOK($propietario, Response::HTTP_CREATED);
        } catch(Throwable $e) {
            DB::rollBack();
            return $this->setResponseErr($e, ErrorCodes::CREATE_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $propietario = Residente::with('condominios')
                        ->findOrFail($id);
            return $this->responseOK($propietario);
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
                'paterno'           => 'required',
                'materno'           => 'required',
                'correo_electronico' => 'required|email',
                'telefono'          => 'required',
                'fecha_nacimiento'  => 'required|date',
                'condominios'       => 'required|array',
            ]);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }

        try {
            DB::beginTransaction();
            $propietario = Residente::findOrFail($id);
            $propietario->update($request->all());
            PropietarioCondominio::where('propietario_id', $propietario->id)
                        ->whereNotIn('condominio_id', $request['condominios'])
                        ->delete();
            foreach($request['condominios'] as $condominio_id) {
                $propietario_condominio = PropietarioCondominio::where('propietario_id', $propietario->id)
                            ->where('condominio_id', $request['condominios'])
                            ->first();
                if ($propietario_condominio == null) {
                    PropietarioCondominio::create([
                        'propietario_id' => $propietario->id,
                        'condominio_id' => $condominio_id,
                    ]);
                }
            }
            DB::commit();
            return $this->responseOK($propietario);
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->setResponseErr($e, ErrorCodes::UPDATE_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $propietario = Residente::findOrFail($id);
            $propietario->delete();
            return $this->responseOK($propietario);
        } catch (ModelNotFoundException $e) {
            return $this->setResponseErr($e, Response::HTTP_NO_CONTENT);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }
    }

}
