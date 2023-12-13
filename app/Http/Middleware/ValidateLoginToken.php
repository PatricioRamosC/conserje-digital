<?php

namespace App\Http\Middleware;

use Throwable;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ValidateLoginToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::debug('middleware - ValidateLoginToken');
        $url = config('services.apis.login_manager_url');
        $token = $request->header('Authorization');
        $response = Http::withHeaders([
            'Authorization' => $token,
            'Content-Type'  => 'application/json',
            ])
            ->post($url);

            // Verificar la respuesta del sistema de Login
        if ($response->status() == 200) {
            Log::debug("Token valido.");
            return $next($request);
        } else {
            Log::debug("Token invalido [$token]");
            return $this->setResponseErrBusiness('invalid-token');
        }
    }

    // public function setResponse($message, $statusCode = Response::HTTP_OK, $payload = null)
    // {
    //     $responseData = [
    //         'message'       => $message
    //     ];
    //     if ($payload != null) {
    //         $responseData['payload'] = $payload;
    //     }
    //     return response()->json([$responseData], $statusCode);
    // }

    // public function setResponseErr(Throwable $ex, $errCode = Response::HTTP_INTERNAL_SERVER_ERROR)
    // {
    //     Log::error($errCode . " : " . $ex->getMessage());
    //     $responseData = [
    //         'error_code'    => $errCode,
    //         'message'       => trans('error-code.' . $errCode)
    //     ];
    //     return response()->json([$responseData], Response::HTTP_INTERNAL_SERVER_ERROR);
    // }

    public function setResponseErrBusiness($errCode) {
        $responseData = [
            'error_code'    => $errCode,
            'message'       => trans('error-code.' . $errCode)
        ];
        return response()->json([$responseData], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

}
