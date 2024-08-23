<?php

namespace App\Http\Controllers;

use App\Data\Guest\GuestStoreData;
use App\Data\Guest\GuestUpdateData;
use App\Http\Controllers\Contracts\ApiController;
use App\Http\Requests\GuestStoreRequest;
use App\Http\Requests\GuestUpdateRequest;
use App\Repositories\Exceptions\RepositoryException;
use App\Repositories\Exceptions\ResourceNotFoundException;
use App\Services\Exceptions\Contracts\ScenarioException;
use App\Services\Exceptions\ScenarioNotFoundException;
use App\Services\Scenarios\Guest\GuestDeleteScenario;
use App\Services\Scenarios\Guest\GuestGetListScenario;
use App\Services\Scenarios\Guest\GuestGetOneScenario;
use App\Services\Scenarios\Guest\GuestStoreScenario;
use App\Services\Scenarios\Guest\GuestUpdateScenario;
use Exception;
use Illuminate\Http\JsonResponse;

class GuestsController extends ApiController
{
    /**
     * @param  GuestGetListScenario  $scenario
     * @return JsonResponse
     */
    public function index(GuestGetListScenario $scenario): JsonResponse
    {
        try {
            return $this->responseSuccess($scenario->handle());
        } catch (Exception) {
            return $this->responseError();
        }
    }

    /**
     * @param  GuestStoreRequest  $request
     * @param  GuestStoreScenario  $scenario
     * @return JsonResponse
     */
    public function store(GuestStoreRequest $request, GuestStoreScenario $scenario): JsonResponse
    {
        $data = GuestStoreData::from($request->validated());
        try {
            return $this->responseCreated(data: $scenario->handle($data));
        } catch (RepositoryException) {
            return $this->responseError();
        }
    }

    /**
     * @param  int  $id
     * @param  GuestGetOneScenario  $scenario
     * @return JsonResponse
     */
    public function show(int $id, GuestGetOneScenario $scenario): JsonResponse
    {
        try {
            return $this->responseFound($scenario->handle($id));
        } catch (ResourceNotFoundException) {
            return $this->responseNotFound();
        } catch (RepositoryException | Exception) {
            return $this->responseError();
        }
    }

    /**
     * @param  GuestUpdateRequest  $request
     * @param  GuestUpdateScenario  $scenario
     * @return JsonResponse
     * @throws ScenarioException
     */
    public function update(GuestUpdateRequest $request, GuestUpdateScenario $scenario): JsonResponse
    {
        $data = GuestUpdateData::from($request->validated());
        try {
            $scenario->handle($data);
        } catch (ScenarioNotFoundException) {
            return $this->responseNotFound();
        }

        return $this->responseSuccess();
    }

    /**
     * @param  int  $id
     * @param  GuestDeleteScenario  $scenario
     * @return JsonResponse
     */
    public function destroy(int $id, GuestDeleteScenario $scenario): JsonResponse
    {
        $result = $scenario->handle($id);
        if (is_null($result)) {
            return $this->responseNotFound();
        }

        return $this->responseNoContent();
    }
}
