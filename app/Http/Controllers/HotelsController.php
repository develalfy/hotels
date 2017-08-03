<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Src\Hotels\HotelsService;

/**
 * Class HotelsController
 * @package App\Http\Controllers
 */
class HotelsController extends Controller
{
    /**
     * @param HotelsService $hotelsService
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(HotelsService $hotelsService)
    {
        $hotels = $hotelsService->listHotels();

        return response()->json(['hotels' => $hotels]);
    }
}
