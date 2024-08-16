<?php

namespace App\Http\Controllers;

use App\Data\Guest\GuestStoreData;
use App\Http\Controllers\Contracts\ApiController;
use App\Http\Requests\GuestStoreRequest;
use App\Repositories\Exceptions\RepositoryException;
use App\Repositories\Exceptions\ResourceNotFoundException;
use App\Services\Exceptions\ServiceException;
use App\Services\Scenarios\GuestDeleteScenario;
use App\Services\Scenarios\GuestGetListScenario;
use App\Services\Scenarios\GuestGetOneScenario;
use App\Services\Scenarios\GuestStoreScenario;
use App\Services\Scenarios\GuestUpdateScenario;
use Illuminate\Http\JsonResponse;

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
            return $this->responseCreated(success: $scenario->handle($data));
        } catch (ServiceException $exception) {
            return $this->responseBadRequest($exception->getMessage());
        } catch (RepositoryException $e) {
            return $this->responseError();
        }
    }

    public function show(int $id, GuestGetOneScenario $scenario): JsonResponse
    {
        try {
            return $this->responseFound($scenario->handle($id));
        } catch (ResourceNotFoundException) {
            return $this->responseNotFound();
        } catch (RepositoryException) {
            return $this->responseError();
        }
    }

    public function update(GuestStoreRequest $request, int $id, GuestUpdateScenario $scenario)
    {

    }

    public function destroy(int $id, GuestDeleteScenario $scenario)
    {

    }
}
