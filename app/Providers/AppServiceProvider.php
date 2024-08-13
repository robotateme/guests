<?php

namespace App\Providers;

use App\Http\Middleware\TerminatingMiddleware;
use App\Services\Contracts\ScenarioInterface;
use App\Services\Contracts\ServiceInterface;
use App\Services\PhoneNumberService;
use App\Services\Scenarios\GuestDeleteScenario;
use App\Services\Scenarios\GuestGetListScenario;
use App\Services\Scenarios\GuestGetOneScenario;
use App\Services\Scenarios\GuestStoreScenario;
use App\Services\Scenarios\GuestUpdateScenario;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ScenarioInterface::class, GuestStoreScenario::class);
        $this->app->bind(ScenarioInterface::class, GuestUpdateScenario::class);
        $this->app->bind(ScenarioInterface::class, GuestDeleteScenario::class);
        $this->app->bind(ScenarioInterface::class, GuestGetOneScenario::class);
        $this->app->bind(ScenarioInterface::class, GuestGetListScenario::class);

        $this->app->bind(ServiceInterface::class, PhoneNumberService::class);
        $this->app->singleton(TerminatingMiddleware::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
