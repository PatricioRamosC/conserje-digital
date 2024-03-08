<?php

namespace App\Http\Controllers\Condominio;

use Throwable;
use App\Models\Condominio\Propietario;
use App\Models\Condominio\PropietarioCondominio;
use Illuminate\Http\Request;
use App\Constants\ErrorCodes;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PropietarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($condominio_id)
    {
        try {
            $propietarios = Propietario::whereHas('condominios', function ($query) use ($condominio_id) {
                        $query->where('condominio_id', $condominio_id);
                    })->get();
            return $this->responseOK($propietarios);
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
                'paterno'           => 'required',
                'materno'           => 'required',
                'correo_electronico' => 'required|email',
                'telefono'          => 'required',
                'fecha_nacimiento'  => 'required|date',
                'condominios'       => 'required|array', // Debe ser un arreglo
                // 'condominios.*'     => 'required|integer|exists:condominios,id',
                // Agrega otras validaciones según tus campos
            ]);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }

        try {
            DB::beginTransaction();
            $propietario = Propietario::create($request->all());
            foreach($request['condominios'] as $condominio) {
                $propietario_condominio = PropietarioCondominio::create([
                    'propietario_id' => $propietario->id,
                    'condominio_id' => $condominio,
                ]);
            }
            DB::commit();
            Log::debug('Propietario creado satisfactoriamente ' . json_encode($propietario));
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
            $propietario = Propietario::with('condominios')
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
            $propietario = Propietario::findOrFail($id);
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
            $propietario = Propietario::findOrFail($id);
            $propietario->delete();
            return $this->responseOK($propietario);
        } catch (ModelNotFoundException $e) {
            return $this->setResponseErr($e, Response::HTTP_NO_CONTENT);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }
    }
}
