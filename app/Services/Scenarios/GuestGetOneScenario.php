<?php

namespace App\Services\Scenarios;

use App\Data\Guest\GuestResponseData;
use App\Repositories\GuestsRepository;
use App\Services\Contracts\ScenarioInterface;
use Illuminate\Contracts\Support\Arrayable;

readonly class GuestGetOneScenario implements ScenarioInterface
{
    public function __construct(private GuestsRepository $repository)
    {
    }

    public function handle(int $id, ?array $with = null, ?string $select = null): array|Arrayable
    {
        $result = $this->repository->getOne($id, select: $select, with: $with);
        return GuestResponseData::from($result);
    }
}