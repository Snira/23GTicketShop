<?php

declare(strict_types=1);

namespace App\Contracts\Repositories;

use App\Models\Ticket;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface TicketRepository
{
    /**
     * @param Model&Ticket
     */
    public function save(Model $model): void;

    /**
     * @return LengthAwarePaginator&Ticket[]
     */
    public function paginate(int $perPage = 10, int $page = 1): LengthAwarePaginator;

    public function saveMany(Collection $tickets): void;

    public function find(int $id): Model;
}
