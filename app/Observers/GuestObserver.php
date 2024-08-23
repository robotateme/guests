<?php

namespace App\Observers;

use App\Data\Guest\GuestStoreData;
use App\Models\Guest;
use App\Services\Exceptions\Contracts\ScenarioException;
use App\Services\Scenarios\Guest\GuestOnSavingScenario;

readonly class GuestObserver
{
    public function __construct(private GuestOnSavingScenario $guestOnSaveScenario)
    {
    }

    /**
     * @param  Guest  $guest
     * @return void
     * @throws ScenarioException
     */
    public function saving(Guest $guest): void {
        $data = $this->guestOnSaveScenario->handle(GuestStoreData::from($guest));
        $guest->fill($data->toArray());
    }
}
