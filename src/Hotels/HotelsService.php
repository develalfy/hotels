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
     * @return int|mixed
     * @internal param $searchArr
     * @internal param $sortArr
     */
    public function listHotels()
    {
        $hotels = $this->hotelRepository->listHotels();

        return $hotels;
    }

    /**
     * @param $hotels
     * @param $searchArr
     * @return mixed
     */
    public function searchHotels($hotels, $searchArr)
    {
        // search for every hotel
        $tempArr = [];
        foreach ($hotels as $hotel) {
            if (Helpers::searchHotels((array)$hotel, $searchArr)) {
                $tempArr[] = $hotel;
            }
        }

        return $tempArr;
    }


    /**
     * @param $hotels
     * @param $sortArr
     * @return mixed
     */
    public function sortHotels($hotels, $sortArr)
    {
        $hotels = Helpers::sortHotels($hotels, $sortArr['sort'], $sortArr['sort_type']);

        return $hotels;
    }
}