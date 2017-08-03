<?php

namespace App\Providers;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Src\Hotels\HotelRepository;
use Src\Hotels\HotelsService;

/**
 * Class HotelServiceProvider
 * @package App\Providers
 */
class HotelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('HotelService', function () {
            $client = new Client();
            $repository = new HotelRepository($client);
            return new HotelsService($repository);
        });
    }
}
