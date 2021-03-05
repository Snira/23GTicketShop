<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\MockObject\MockObject;
use RuntimeException;
use UnexpectedValueException;

abstract class AbstractModelRepository
{
    protected static string $modelClass;
    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function find(int $id): Model
    {
        return $this->newQuery()->where('id', $id)->first();
    }

    public function save(Model $model): void
    {
        if (get_class($model) !== static::$modelClass && !$model instanceof MockObject) {
            throw new UnexpectedValueException(
                'Unexpected model class: ' . static::$modelClass . ' expected, ' . get_class($model) . 'given'
            );
        }

        if (!$model->save()) {
            throw new RuntimeException('Could not save model [' . get_class($model) . ']');
        }
    }

    public function paginate(int $perPage = 10, int $page = 1): LengthAwarePaginator
    {
        $query = $this->newQuery();

        return $query->paginate($perPage, ['*'], 'page', $page);
    }

    private function newQuery(): Builder
    {
        return $this->container->make(static::$modelClass)->query();
    }
}
