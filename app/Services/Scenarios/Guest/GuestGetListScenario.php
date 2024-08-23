<?php

namespace App\Services\Scenarios\Guest;

use App\Data\Guest\GuestResponseData;
use App\Repositories\GuestsRepository;
use Illuminate\Contracts\Support\Arrayable;

readonly class GuestGetListScenario
{
    public function __construct(private GuestsRepository $guestsRepository)
    {
    }

    public function handle(): array|Arrayable
    {
        return GuestResponseData::collect($this->guestsRepository->getList());
    }
}