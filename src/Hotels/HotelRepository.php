<?php

namespace Src\Hotels;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

/**
 * Created by PhpStorm.
 * User: develalfy
 * Date: 8/3/17
 * Time: 6:43 PM
 */
class HotelRepository
{
    /**
     * @var Client
     */
    private $client;

    /**
     * HotelRepository constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return int|mixed
     */
    public function listHotels()
    {
        try {
            // we could use api uri -> as env
            $hotelsJson = $this->client->request('GET', env('API_URL', 'https://api.myjson.com/bins/tl0bp'));
        } catch (ClientException $e) {
            return $e->getMessage();
        }


        $hotels = json_decode($hotelsJson->getBody()->getContents())->hotels;

        return $hotels;
    }
}