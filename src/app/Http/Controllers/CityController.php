<?php

namespace JamesGordo\JapanPostalCode\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use JamesGordo\JapanPostalCode\Services\Japan;

class CityController extends Controller
{
    public function __invoke(Japan $japan): JsonResponse
    {
        $cities = Cache::remember('jp.cities', 3600, function () use ($japan) {
            return $japan->cities();
        });

        return response()->json($cities);
    }
}
