<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Contracts\ApiController;
use App\Http\Requests\GuestStoreRequest;
use App\Services\Scenarios\GuestDeleteScenario;
use App\Services\Scenarios\GuestGetListScenario;
use App\Services\Scenarios\GuestGetOneScenario;
use App\Services\Scenarios\GuestStoreScenario;
use App\Services\Scenarios\GuestUpdateScenario;

class GuestsController extends ApiController
{
    public function index(GuestGetListScenario $scenario)
    {
        sleep(1);
        return [
            'test' => 1
        ];
    }

    public function store(GuestStoreRequest $request, GuestStoreScenario $scenario)
    {
        return [
            'test' => 1
        ];
    }

    public function show(int $id, GuestGetOneScenario $scenario)
    {

    }

    public function update(GuestStoreRequest $request, int $id, GuestUpdateScenario $scenario)
    {

    }

    public function destroy(int $id, GuestDeleteScenario $scenario)
    {

    }
}
