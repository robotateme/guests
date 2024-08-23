<?php

namespace App\Services\Scenarios\Guest;

use App\Data\Guest\GuestUpdateData;
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
        if (!$this->guestsRepository->existsById($data->id)) {
            throw new ScenarioNotFoundException();
        }
        return $this->guestsRepository->update($data->id, $data->except('id')->toArray());
    }
}