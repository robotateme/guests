<?php

namespace App\Services\Scenarios\Guest;

use App\Data\Guest\GuestUpdateData;
use App\Repositories\Exceptions\ResourceNotFoundException;
use App\Repositories\GuestsRepository;
use App\Services\Exceptions\Contracts\ScenarioException;
use App\Services\Exceptions\ScenarioNotFoundException;

readonly class GuestUpdateScenario
{
    public function __construct(private GuestsRepository $guestsRepository)
    {
    }

    /**
     * @param  GuestUpdateData  $data
     * @return bool
     * @throws ScenarioException
     */
    public function handle(GuestUpdateData $data): bool
    {
        try {
            return $this->guestsRepository->update($data->id, $data->except('id')->toArray());
        } catch (ResourceNotFoundException) {
            throw new ScenarioNotFoundException();
        }
    }
}