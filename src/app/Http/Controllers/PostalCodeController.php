<?php

namespace JamesGordo\JapanPostalCode\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use JamesGordo\JapanPostalCode\Services\Japan;

class PostalCodeController extends Controller
{
    public function retrieve($code): JsonResponse
    {
        $statusCode = 200;

        try {
            $payload = Cache::remember("postal.$code", 3600, function () use ($code) {
                return (new Japan())->postalCode($code);
            });
        } catch (Exception $e) {
            $payload = ['error' => $e->getMessage()];
        }

        return response()->json($payload, $statusCode);
    }
}
