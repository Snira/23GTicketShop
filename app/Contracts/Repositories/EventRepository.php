<?php

declare(strict_types=1);

namespace App\Contracts\Repositories;

use App\Models\Event;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

interface EventRepository
{
    /**
     * @param Model&Event
     */
    public function save(Model $model): void;

    /**
     * @return LengthAwarePaginator&Event[]
     */
    public function paginate(int $perPage = 10, int $page = 1): LengthAwarePaginator;

    public function find(int $id): Model;
}
