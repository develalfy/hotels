<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;
use Src\Hotels\Helpers;
use Src\Hotels\HotelsService;

/**
 * Class HotelsController
 * @package App\Http\Controllers
 */
class HotelsController extends Controller
{
    /**
     * List hotels controller
     * @param HotelsService $hotelsService
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(HotelsService $hotelsService)
    {
        // search params
        $searchArr = array(
            'name' => Input::get('name'),
            'city' => Input::get('city'),
            'price_from' => Input::get('price_from'),
            'price_to' => Input::get('price_to'),
            'date_from' => Input::get('date_from'),
            'date_to' => Input::get('date_to')
        );

        // sort params
        $sortArr = array(
            'sort' => Input::get('sort'),
            'sort_type' => Input::get('sort_type')
        );

        // Get all hotels
        $hotels = $hotelsService->listHotels();

        // Filter if needed
        if (Helpers::checkFiltering($searchArr) > 0) {
            $hotels = $hotelsService->searchHotels($hotels, $searchArr);
        }

        // Sort if needed
        if ($sortArr['sort']) {
            $hotels = $hotelsService->sortHotels($hotels, $sortArr);
        }


        return response()->json(['hotels' => $hotels]);
    }
}
