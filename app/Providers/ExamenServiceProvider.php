<?php

namespace App\Providers;

use App\Interfaces\ExamenServiceInterface;
use App\Services\ExamenService;
use Illuminate\Support\ServiceProvider;

class ExamenServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ExamenServiceInterface::class, ExamenService::class);//
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
