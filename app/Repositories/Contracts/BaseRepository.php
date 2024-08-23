<?php

namespace App\Repositories\Contracts;

use App\Repositories\Exceptions\RepositoryException;
use App\Repositories\Exceptions\ResourceNotFoundException;
use Closure;
use Exception;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Database\Query\Builder as BuilderContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Expression;
abstract class BaseRepository implements RepositoryInterface
{
    public function __construct(private readonly Model $model)
    {

    }

    /**
     * @param  array|Closure|null  $where
     * @param  Expression|string|null  $select
     * @param  array|Closure|null  $with
     * @return array|Arrayable
     */
    public function getList(
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
     * @throws RepositoryException
     */
    public function getOne(
        int $id,
        null|array|Closure $where = null,
        Expression|string|null $select = null,
        null|array|Closure $with = null,
    ): array|Arrayable {
        $result = $this->getBuilder()
            ->when(!is_null($select), fn(Builder $query) => $query->select($select))
            ->when(!is_null($where), fn(Builder $query) => $query->where($where))
            ->when(!is_null($with), fn(Builder $query) => $query->with($where))
            ->find($id);

        if (is_null($result)) {
            throw new ResourceNotFoundException("Resource not found");
        }
        return $result->toArray();
    }

    /**
     * @param  int  $id
     * @return bool
     */
    public function existsById(int $id): bool
    {
        return $this->getBuilder()
            ->where('id', '=', $id)
            ->exists();
    }

    /**
     * @param  array  $attributes
     * @return array
     * @throws RepositoryException
     */
    public function create(array $attributes): array
    {
        try {
            return $this->getBuilder()
                ->create($attributes)
                ->toArray();

        } catch (Exception $e) {
            throw new RepositoryException($e);
        }
    }

    /**
     * @param $id
     * @param  array  $attributes
     * @return bool
     */
    public function update($id, array $attributes): bool
    {
        return $this->getBuilder()
            ->find($id)->update($attributes) > 0;
    }

    /**
     * @param  int  $id
     * @return bool|null
     */
    public function deleteById(int $id): ?bool
    {
        return $this->getBuilder()
            ->find($id)?->delete();
    }

    /**
     * @return Builder
     */
    private function getBuilder(): BuilderContract
    {
        return $this->model->newQuery();
    }
}