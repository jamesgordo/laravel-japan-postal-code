<?php

namespace App\Http\Controllers;

namespace JamesGordo\JapanPostalCode\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use JamesGordo\JapanPostalCode\Services\Japan;

class PrefectureController extends Controller
{
    public function __invoke(Japan $japan): JsonResponse
    {
        $prefectures = Cache::remember('jp.prefectures', 3600, function () use ($japan) {
            return $japan->prefectures();
        });

        return response()->json($prefectures);
    }
}
