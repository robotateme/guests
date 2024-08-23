<?php

namespace App\Services\Scenarios\Guest;

use App\Repositories\GuestsRepository;

readonly class GuestDeleteScenario
{
    public function __construct(private GuestsRepository $guestsRepository)
    {
    }

    public function handle(int $id): bool|null
    {
        return $this->guestsRepository->deleteById($id);
    }
}