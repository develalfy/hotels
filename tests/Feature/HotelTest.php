<?php

namespace Tests\Feature;

use Mockery;
use Src\Hotels\HotelRepository;
use Src\Hotels\HotelsService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class HotelTest
 * @package Tests\Feature
 */
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

    /**
     * test list hotels service
     */
    public function testListHotels()
    {
        $hotels = [
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
            ],
            [
                "name" => "Silver Tulip",
                "price" => 50,
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
            ],
            [
                "name" => "Normal Tulip",
                "price" => 90.6,
                "city" => "delhi",
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
            ->andReturn($hotels);

        $service = new HotelsService($repository);
        $this->assertEquals($hotels, $service->listHotels());

    }

    /**
     * test search hotels service
     */
    public function testSearchHotels()
    {
        $hotels = [
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
            ],
            [
                "name" => "Silver Tulip",
                "price" => 50,
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
            ],
            [
                "name" => "Normal Tulip",
                "price" => 90.6,
                "city" => "delhi",
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

        // search params
        $searchArr = array(
            'name' => 'Golden Tulip',
            'city' => 'paris',
            'price_from' => '50',
            'price_to' => '110',
            'date_from' => '10-10-2020',
            'date_to' => '17-10-2020'
        );


        $repository = Mockery::mock(HotelRepository::class);

        $repository->shouldReceive('listHotels')
            ->andReturn($hotels);

        $service = new HotelsService($repository);
        $this->assertEquals($hotels, $service->searchHotels($hotels, $searchArr));
    }

    /**
     * test sort hotels service
     */
    public function testSortHotels()
    {
        $hotels = [
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
            ],
            [
                "name" => "Silver Tulip",
                "price" => 90,
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
            ],
            [
                "name" => "Normal Tulip",
                "price" => 50.6,
                "city" => "delhi",
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

        // sort params
        $sortArr = array(
            'sort' => 'price',
            'sort_type' => 'desc'
        );


        $repository = Mockery::mock(HotelRepository::class);

        $repository->shouldReceive('listHotels')
            ->andReturn($hotels);

        $service = new HotelsService($repository);

        $this->assertEquals($hotels, $service->sortHotels($hotels, $sortArr));
    }
}
