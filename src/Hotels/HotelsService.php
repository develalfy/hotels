<?php
/**
 * Created by PhpStorm.
 * User: develalfy
 * Date: 8/3/17
 * Time: 7:05 PM
 */

namespace Src\Hotels;

use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;

/**
 * Class HotelsService
 * @package Src\Hotels
 */
class HotelsService
{
    /**
     * @var HotelRepository
     */
    private $hotelRepository;

    /**
     * HotelsService constructor.
     * @param HotelRepository $hotelRepository
     */
    public function __construct(HotelRepository $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository;
    }

    /**
     * @return int|mixed
     */
    public function listHotels()
    {
        $hotels = $this->hotelRepository->listHotels();


        $searchArr = array(
            'name' => Input::get('name'),
            'city' => Input::get('city'),
            'price_from' => Input::get('price_from'),
            'price_to' => Input::get('price_to'),
            'date_from' => Input::get('date_from'),
            'date_to' => Input::get('date_to')
        );

        // if no params as filters return all hotels
        if ($this->checkFiltering($searchArr) == 0) {
            if (Input::get('sort')) {
                return $this->sortHotels($hotels, Input::get('sort'), Input::get('sort_type'));
            }
            return $hotels;
        }

        $tempArr = [];

        // search for every hotel
        foreach ($hotels as $hotel) {
            if ($this->searchHotels((array)$hotel, $searchArr)) {
                $tempArr[] = $hotel;
            }
        }

        if (Input::get('sort')) {
            return $this->sortHotels($tempArr, Input::get('sort'), Input::get('sort_type'));
        }

        return $tempArr;
    }

    /**
     * Search hotels
     * @param $hotel
     * @param $searchArr
     * @return bool
     */
    private function searchHotels($hotel, $searchArr)
    {
        // status of the hotel to be shown or not
        $status = false;

        $searchArr['name'] != null and strtolower($hotel['name']) == strtolower($searchArr['name']) ? $status = true : $status = false;

        $searchArr['city'] != null and strtolower($hotel['city']) == strtolower($searchArr['city']) ? $status = true : $status = false;

        $searchArr['price_from'] != null and intval($searchArr['price_from']) <= intval($hotel['price']) ? $status = true : $status = false;

        $searchArr['price_to'] != null and intval($searchArr['price_to']) >= intval($hotel['price']) ? $status = true : $status = false;

        if ($searchArr['date_from'] != null or $searchArr['date_to'] != null) {
            $this->checkDate($searchArr['date_from'], $searchArr['date_to'], $hotel['availability']) ? $status = true : $status = false;
        }

        //$searchArr['date_to'] != null and $this->checkDateTo($searchArr['date_to'], $hotel['availability']) ? $status = true : $status = false;


        return $status;
    }

    /**
     * Return how many filter as params
     * @param $searchArr
     * @return int
     */
    private function checkFiltering($searchArr)
    {
        $count = 0;
        foreach ($searchArr as $item) {
            if ($item) {
                $count += 1;
            }
        }

        return $count;
    }

    /**
     * Search between date_from and date_to
     * @param $dateFrom
     * @param $dateTo
     * @param $dateArr
     * @return bool
     */
    private function checkDate($dateFrom, $dateTo, $dateArr)
    {
        // if date_from or date_to not set in search let it 1
        $statusFrom = $dateFrom ? 0 : 1;
        $statusTo = $dateTo ? 0 : 1;

        foreach ($dateArr as $date) {
            if (Carbon::parse($dateFrom) >= Carbon::parse($date->from)) {
                $statusFrom = 1;
            }
            if (Carbon::parse($dateTo) <= Carbon::parse($date->to)) {
                $statusTo = 1;
            }
        }


        // if sum of from + to = 2 (more than 1) pass
        $status = $statusFrom + $statusTo;

        return $status > 1 ? true : false;
    }

    private function sortHotels($hotels, $sort, $type)
    {
        $type == 'desc' ? $type = 'desc' : $type = 'asc';

        // Requires PHP 7
        usort($hotels, function($item1, $item2) use ($sort, $type){
            if ($type == 'desc') {
                return $item2->$sort <=> $item1->$sort;
            }

            return $item1->$sort <=> $item2->$sort;
        });

        return $hotels;
    }
}