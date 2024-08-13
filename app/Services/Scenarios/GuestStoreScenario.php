<?php

namespace App\Services\Scenarios;

use App\Data\Guest\GuestStoreData;
use App\Repositories\GuestsRepository;
use App\Services\PhoneNumberService;

readonly class GuestStoreScenario
{
    public function __construct(
        private PhoneNumberService $phoneService,
        private GuestsRepository $guestsRepository
    )
    {

    }

    public function handle(GuestStoreData $guestStoreData)
    {
    }
}