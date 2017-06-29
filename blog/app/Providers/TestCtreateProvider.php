<?php

//通过php artisan make:provider TestCreateProvider创建该服务提供者
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TestCtreateProvider extends ServiceProvider
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
        //
    }
}
