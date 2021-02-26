<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        \App\Repositories\BrandRepository::class => \App\Repositories\BrandRepositoryEloquent::class,
        \App\Repositories\CarRepository::class => \App\Repositories\CarRepositoryEloquent::class
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
