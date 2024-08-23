<?php

namespace App\Services\Scenarios\Guest;

use App\Data\Guest\GuestResponseData;
use App\Data\Guest\GuestStoreData;
use App\Repositories\Exceptions\RepositoryException;
use App\Repositories\GuestsRepository;
use Illuminate\Contracts\Support\Arrayable;

readonly class GuestStoreScenario
{
    public function __construct(
        private GuestsRepository $guestsRepository
    )
    {

    }

    /**
     * @param  GuestStoreData  $guestStoreData
     * @return array|Arrayable
     * @throws RepositoryException
     */
    public function handle(GuestStoreData $guestStoreData): array|Arrayable
    {
        $result = $this->guestsRepository->create($guestStoreData->toArray());
        return GuestResponseData::from($result);
    }
}