<?php

namespace Tests\Feature;

use Mockery;
use Src\Hotels\HotelRepository;
use Src\Hotels\HotelsService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HotelTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    /*public function setUp()
    {
        parent::setUp();

    }*/

    public function testListHotels()
    {
        $array = [
            [
                "name" => "Golden Tulip",
                "price" => 109.6,
                "city" => "paris",
                "availability" => [
                    [
                        "from" => "10-10-2020",
                        "to" => "15-10-2020"
                    ],
                    [
                        "from" => "25-10-2020",
                        "to" => "15-11-2020"
                    ],
                    [
                        "from" => "10-12-2020",
                        "to" => "15-12-2020"
                    ]
                ]
            ]
        ];

        $repository = Mockery::mock(HotelRepository::class);

        $repository->shouldReceive('listHotels')
            ->andReturn($array);

        $service = new HotelsService($repository);
        $this->assertEquals($array, $service->listHotels());

    }
}
