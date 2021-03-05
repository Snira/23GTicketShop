<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Repositories\TicketRepository as TicketRepositoryContract;
use App\Models\Ticket;
use Illuminate\Support\Collection;

final class TicketRepository extends AbstractModelRepository implements TicketRepositoryContract
{
    protected static string $modelClass = Ticket::class;

    public function saveMany(Collection $tickets): void
    {
        $tickets->each(
            function (Ticket $ticket) {
                $this->save($ticket);
            }
        );
    }
}
