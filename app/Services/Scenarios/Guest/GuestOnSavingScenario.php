<?php

namespace App\Services\Scenarios\Guest;

use App\Data\Guest\GuestStoreData;
use App\Services\Contracts\ServiceInterface;
use App\Services\Exceptions\Contracts\ScenarioException;
use App\Services\PhoneNumberService;
use libphonenumber\NumberParseException;

readonly class GuestOnSavingScenario implements ServiceInterface
{
    public function __construct(private PhoneNumberService $phoneNumberService)
    {
    }

    /**
     * @throws ScenarioException
     */
    public function handle(GuestStoreData $guestStoreData): GuestStoreData
    {
        if (is_null($guestStoreData->country)) {
            try {
                $phoneData = $this->phoneNumberService->getInfo($guestStoreData->phoneNumber);
                $guestStoreData->country = $phoneData->countryName;
            } catch (NumberParseException $exception) {
                throw new ScenarioException($exception->getMessage());
            }
        }

        return $guestStoreData;
    }
}