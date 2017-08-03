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
     * @return int|mixed
     */
    public function listHotels()
    {
        $hotels = $this->hotelRepository->listHotels();

        // todo: filter then sort
        return $hotels;
    }
}