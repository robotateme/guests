<?php

namespace App\Repositories\Contracts;

use Closure;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\Data;

abstract class BaseRepository implements RepositoryInterface
{
    public const string TABLE_NAME = 'guests';

    public function __construct(private readonly Model $model)
    {
    }

    /**
     * @param  array|Closure|null  $where
     * @param  array|Closure|null  $with
     * @param  Closure|null  $callback
     * @return array|Arrayable
     */
    protected function getList(
        null|array|Closure $where = null,
        null|array|Closure $with = null,
        ?Closure $callback = null
    ): array|Arrayable {
        $data = $this->getBuilder()
            ->when(!is_null($where), fn(Builder $query) => $query->where($where))
            ->when(!is_null($with), fn(Builder $query) => $query->with($where));

        return $this->prepareData($data, $callback);
    }

    /**
     * @param  int  $id
     * @param  array|Closure|null  $where
     * @param  array|Closure|null  $with
     * @param  Closure|null  $callback
     * @return array|Arrayable
     */
    public function getOne(
        int $id,
        null|array|Closure $where = null,
        null|array|Closure $with = null,
        ?Closure $callback = null
    ): array|Arrayable {
        $data = $this->getBuilder()
            ->when(!is_null($where), fn(Builder $query) => $query->where($where))
            ->when(!is_null($with), fn(Builder $query) => $query->with($where))
            ->find($id);

        return $this->prepareData($data, $callback);
    }

    /**
     * @param  Data  $attributes
     * @return bool
     */
    public function create(Data $attributes): bool
    {
        return $this->getBuilder()->insert($attributes->toArray());
    }

    public function update(Data $attributes): int
    {
        return $this->getBuilder()->update($attributes->toArray());
    }

    private function getBuilder(): Builder
    {
        return $this->model->newQuery();
    }

    protected function prepareData(Arrayable|array $data, ?Closure $callback = null): Arrayable|array
    {
        if (!is_null($callback)) {
            return $callback();
        }

        return $data;
    }
}