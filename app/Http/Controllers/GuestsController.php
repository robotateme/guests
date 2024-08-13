<?php

namespace App\Http\Controllers;

use App\Data\Guest\GuestStoreData;
use App\Http\Controllers\Contracts\ApiController;
use App\Http\Requests\GuestStoreRequest;
use App\Services\Exceptions\ScenarioException;
use App\Services\Scenarios\GuestDeleteScenario;
use App\Services\Scenarios\GuestGetListScenario;
use App\Services\Scenarios\GuestGetOneScenario;
use App\Services\Scenarios\GuestStoreScenario;
use App\Services\Scenarios\GuestUpdateScenario;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GuestsController extends ApiController
{
    public function index(GuestGetListScenario $scenario)
    {
        sleep(1);
        return [
            'test' => 1
        ];
    }

    public function store(GuestStoreRequest $request, GuestStoreScenario $scenario): JsonResponse
    {
        $data = GuestStoreData::from($request->validated());
        try {
            return new JsonResponse([
                'success' => $scenario->handle($data),
                'message' => 'Created successfully!',
            ], Response::HTTP_CREATED);
        } catch (ScenarioException $e) {
            return new JsonResponse([
                'success' => false,
                'message' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function show(int $id, GuestGetOneScenario $scenario)
    {
        return new JsonResponse([
            'test' => 1
        ]);
    }

    public function update(GuestStoreRequest $request, int $id, GuestUpdateScenario $scenario)
    {

    }

    public function destroy(int $id, GuestDeleteScenario $scenario)
    {

    }
}
