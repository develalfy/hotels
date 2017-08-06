<?php

namespace Src\Hotels;

use Carbon\Carbon;

/**
 * Class Helpers: some custom methods to call from service
 * @package Src\Hotels
 */
class Helpers{

    /**
     * Search hotels
     * @param $hotel
     * @param $searchArr
     * @return bool
     * @internal param Helpers $helpers
     */
    public static function searchHotels($hotel, $searchArr)
    {
        // status of the hotel to be shown or not
        $status = false;

        $searchArr['name'] != null and strtolower($hotel['name']) == strtolower($searchArr['name']) ? $status = true : $status = false;

        $searchArr['city'] != null and strtolower($hotel['city']) == strtolower($searchArr['city']) ? $status = true : $status = false;

        $searchArr['price_from'] != null and intval($searchArr['price_from']) <= intval($hotel['price']) ? $status = true : $status = false;

        $searchArr['price_to'] != null and intval($searchArr['price_to']) >= intval($hotel['price']) ? $status = true : $status = false;

        if ($searchArr['date_from'] != null or $searchArr['date_to'] != null) {
            self::checkDate($searchArr['date_from'], $searchArr['date_to'], $hotel['availability']) ? $status = true : $status = false;
        }


        return $status;
    }

    /**
     * Return how many filter as params
     * @param $searchArr
     * @return int
     */
    public static function checkFiltering($searchArr)
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
    private static function checkDate($dateFrom, $dateTo, $dateArr)
    {
        // if date_from or date_to not set in search let it 1
        $statusFrom = $dateFrom ? 0 : 1;
        $statusTo = $dateTo ? 0 : 1;

        foreach ($dateArr as $date) {
            $date = (array) $date;
            if (Carbon::parse($dateFrom) >= Carbon::parse($date['from'])) {
                $statusFrom = 1;
            }
            if (Carbon::parse($dateTo) <= Carbon::parse($date['to'])) {
                $statusTo = 1;
            }
        }


        // if sum of from + to = 2 (more than 1) pass
        $status = $statusFrom + $statusTo;

        return $status > 1 ? true : false;
    }

    /**
     * @param $hotels
     * @param $sort
     * @param $type
     * @return mixed
     */
    public static function sortHotels($hotels, $sort, $type)
    {
        $type == 'desc' ? $type = 'desc' : $type = 'asc';

        usort($hotels, function($item1, $item2) use ($sort, $type){
            $item1 = (array) $item1;
            $item2 = (array) $item2;
            if ($type == 'desc') {
                return $item2[$sort]<=> $item1[$sort];
            }

            return $item1[$sort]<=> $item2[$sort];
        });

        return $hotels;
    }
}