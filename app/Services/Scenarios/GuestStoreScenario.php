<?php

namespace App\Services\Scenarios;

use App\Data\Guest\GuestStoreData;
use App\Repositories\GuestsRepository;
use App\Services\Exceptions\ScenarioException;
use App\Services\PhoneNumberService;

readonly class GuestStoreScenario
{
    public function __construct(
        private PhoneNumberService $phoneService,
        private GuestsRepository $guestsRepository
    )
    {

    }

    /**
     * @throws ScenarioException
     */
    public function handle(GuestStoreData $guestStoreData): bool
    {
        if (is_null($guestStoreData->country)) {
            try {
                $phoneData = $this->phoneService->getInfo($guestStoreData->phoneNumber);
                $guestStoreData->country = $phoneData->countryCode;
            } catch (ScenarioException $e) {
                throw new ScenarioException($e->getMessage());
            }
        }

        return $this->guestsRepository->create($guestStoreData);
    }
}