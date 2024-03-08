<?php

namespace App\Http\Controllers\Visitas;

use Throwable;
use App\Models\Visitas\Visita;
use App\Models\Visitas\VisitaMotivo;
use Illuminate\Http\Request;
use App\Constants\ErrorCodes;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;

class VisitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($condominio_id)
    {
        try {
            $visitas = Visita::whereHas('propiedad', function ($query) use ($condominio_id) {
                    $query->where('condominio_id', $condominio_id);
                })
                ->with('visitante')
                ->paginate(env('PAGINATE_VISITAS', env('PAGINATE', 50)));
            return $this->responseOK($visitas);
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
                'fecha_inicio'       => 'required',
                'fecha_fin'          => 'nullable',
                'visita_motivo_id'   => 'required',
                'visitante_id'       => 'required',
                'propiedad_id'       => 'required|exists:propiedades,id',
                // Agrega otras validaciones según tus campos
            ]);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }

        try {
            $visita = Visita::create($request->all());
            return $this->responseOK($visita, Response::HTTP_CREATED);
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
            $visita = Visita::findOrFail($id);
            return $this->responseOK($visita);
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
                'fecha_inicio'       => 'required',
                'fecha_fin'          => 'nullable',
                'visita_motivo_id'   => 'required',
                'visitante_id'       => 'required',
                'propiedad_id'       => 'required|exists:propiedades,id',
                // Agrega otras validaciones según tus campos
            ]);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }

        try {
            $visita = Visita::findOrFail($id);
            $visita->update($request->all());
            return $this->responseOK($visita);
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
            $visita = Visita::findOrFail($id);
            $visita->delete();
            return $this->responseOK($visita);
        } catch (ModelNotFoundException $e) {
            return $this->setResponseErr($e, Response::HTTP_NO_CONTENT);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }
    }

}
