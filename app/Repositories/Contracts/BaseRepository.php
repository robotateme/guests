<?php

namespace App\Repositories\Contracts;

use Closure;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Expression;
use Spatie\LaravelData\Data;

abstract class BaseRepository implements RepositoryInterface
{
    public const string TABLE_NAME = 'guests';

    public function __construct(private readonly Model $model)
    {
    }

    /**
     * @param  array|Closure|null  $where
     * @param  Expression|string|null  $select
     * @param  array|Closure|null  $with
     * @return array|Arrayable
     */
    protected function getList(
        null|array|Closure $where = null,
        Expression|string|null $select = null,
        null|array|Closure $with = null,
    ): array|Arrayable {
        return $this->getBuilder()
            ->when(!is_null($select), fn(Builder $query) => $query->select($select))
            ->when(!is_null($where), fn(Builder $query) => $query->where($where))
            ->when(!is_null($with), fn(Builder $query) => $query->with($where))
            ->get();
    }

    /**
     * @param  int  $id
     * @param  array|Closure|null  $where
     * @param  Expression|string|null  $select
     * @param  array|Closure|null  $with
     * @return array|Arrayable
     */
    public function getOne(
        int $id,
        null|array|Closure $where = null,
        Expression|string|null $select = null,
        null|array|Closure $with = null,
    ): array|Arrayable {
        return $this->getBuilder()
            ->when(!is_null($select), fn(Builder $query) => $query->select($select))
            ->when(!is_null($where), fn(Builder $query) => $query->where($where))
            ->when(!is_null($with), fn(Builder $query) => $query->with($where))
            ->find($id)
            ->toArray();
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
}