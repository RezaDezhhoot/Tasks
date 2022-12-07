<?php

namespace App\Providers;

use App\Repositories\Classes\MoviesRepository;
use App\Repositories\Interfaces\MoviesRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(MoviesRepositoryInterface::class,MoviesRepository::class);
    }
}
