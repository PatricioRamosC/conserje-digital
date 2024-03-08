<?php

namespace App\Http\Controllers\Generales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Throwable;
use App\Models\Generales\Delivery;
use App\Constants\ErrorCodes;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeliveryController extends Controller
{
    public function index($condominio_id) {
        try {
            $deliveries = Delivery::where('condominio_id', $condominio_id)
                ->get();
            return $this->responseOK($deliveries);
        } catch (ModelNotFoundException $e) {
            return $this->setResponseErr($e, Response::HTTP_NO_CONTENT);
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
                'nombre'        => 'required',
                'condominio_id' => 'required|exists:condominios,id',
            ]);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }
        try {
            $delivery = Delivery::create($request->all());
            return $this->responseOK($delivery, Response::HTTP_CREATED);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::CREATE_ERROR);
        }
    }

}
