<?php

namespace App\Services\Scenarios\Guest;

use App\Data\Guest\GuestResponseData;
use App\Repositories\Exceptions\RepositoryException;
use App\Repositories\GuestsRepository;
use App\Services\Contracts\ScenarioInterface;
use Illuminate\Contracts\Support\Arrayable;

readonly class GuestGetOneScenario implements ScenarioInterface
{
    public function __construct(private GuestsRepository $repository)
    {
    }

    /**
     * @param  int  $id
     * @param  array|null  $with
     * @param  string|null  $select
     * @return array|Arrayable
     * @throws RepositoryException
     */
    public function handle(int $id, ?array $with = null, ?string $select = null): array|Arrayable
    {
        $result = $this->repository->getOne($id, select: $select, with: $with);
        return GuestResponseData::from($result);
    }
}