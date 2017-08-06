<?php
/**
 * Created by PhpStorm.
 * User: develalfy
 * Date: 8/3/17
 * Time: 7:05 PM
 */

namespace Src\Hotels;

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
     * List hotels
     * @param $searchArr
     * @param $sortArr
     * @return int|mixed
     */
    public function listHotels($searchArr, $sortArr)
    {
        $hotels = $this->hotelRepository->listHotels();

        // if no params as filters return all hotels
        if (Helpers::checkFiltering($searchArr) == 0) {
            if ($sortArr['sort']) {
                return Helpers::sortHotels($hotels, $sortArr['sort'], $sortArr['sort_type']);
            }

            return $hotels;
        }

        // search for every hotel
        $tempArr = [];
        foreach ($hotels as $hotel) {
            if (Helpers::searchHotels((array)$hotel, $searchArr)) {
                $tempArr[] = $hotel;
            }
        }

        // is  fort is param then sort hotels
        if ($sortArr['sort']) {
            return Helpers::sortHotels($tempArr, $sortArr['sort'], $sortArr['sort_type']);
        }

        return $tempArr;
    }

}