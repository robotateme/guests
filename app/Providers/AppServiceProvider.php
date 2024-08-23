<?php

namespace App\Providers;

use App\Http\Middleware\TerminatingMiddleware;
use App\Services\Contracts\ScenarioInterface;
use App\Services\Contracts\ServiceInterface;
use App\Services\PhoneNumberService;
use App\Services\Scenarios\Guest\GuestDeleteScenario;
use App\Services\Scenarios\Guest\GuestGetListScenario;
use App\Services\Scenarios\Guest\GuestGetOneScenario;
use App\Services\Scenarios\Guest\GuestOnSavingScenario;
use App\Services\Scenarios\Guest\GuestStoreScenario;
use App\Services\Scenarios\Guest\GuestUpdateScenario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Event;
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
        $this->app->bind(ScenarioInterface::class, GuestOnSavingScenario::class);

        $this->app->bind(ServiceInterface::class, PhoneNumberService::class);
        $this->app->singleton(TerminatingMiddleware::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
