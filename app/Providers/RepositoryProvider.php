<?php

namespace App\Providers;

use App\Models\Guest;
use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\GuestsRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(RepositoryInterface::class, GuestsRepository::class);
        $this->app->when(GuestsRepository::class)
            ->needs(Model::class)
            ->give(Guest::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
