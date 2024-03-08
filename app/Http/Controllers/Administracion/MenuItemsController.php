<?php

namespace App\Http\Controllers\Administracion;

use App\Models\Administracion\MenuItem;
use Illuminate\Http\Request;
use Throwable;
use App\Constants\ErrorCodes;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;

class MenuItemsController extends Controller
{
    public function show($userId) {
        try {
            $motivo = MenuItem::all();
            return $this->responseOK($motivo);
        } catch (ModelNotFoundException $e) {
            return $this->setResponseErr($e, Response::HTTP_NO_CONTENT);
        } catch(Throwable $e) {
            return $this->setResponseErr($e, ErrorCodes::VALIDATION_ERROR);
        }
    }
}
