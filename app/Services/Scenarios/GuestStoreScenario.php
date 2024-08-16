<?php

namespace App\Services\Scenarios;

use App\Data\Guest\GuestStoreData;
use App\Repositories\Exceptions\RepositoryException;
use App\Repositories\GuestsRepository;
use App\Services\Exceptions\ScenarioException;
use App\Services\Exceptions\ServiceException;
use App\Services\PhoneNumberService;
use libphonenumber\NumberParseException;

readonly class GuestStoreScenario
{
    public function __construct(
        private PhoneNumberService $phoneService,
        private GuestsRepository $guestsRepository
    )
    {

    }

    /**
     * @throws ServiceException|RepositoryException
     */
    public function handle(GuestStoreData $guestStoreData): bool
    {
        if (is_null($guestStoreData->country)) {
            try {
                $phoneData = $this->phoneService->getInfo($guestStoreData->phoneNumber);
                $guestStoreData->country = $phoneData->countryCode;
            } catch (NumberParseException $exception) {
                throw new ServiceException($exception->getMessage());
            }
        }

        return $this->guestsRepository->create($guestStoreData);
    }
}