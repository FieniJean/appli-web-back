<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;



use App\Repositories\ContratRepository;
use App\Repositories\ContratRepositoryInterface;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ContratRepositoryInterface::class, ContratRepository::class);

        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
