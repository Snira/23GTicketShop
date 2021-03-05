<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Repositories\EventRepository as EventRepositoryContract;
use App\Models\Event;

final class EventRepository extends AbstractModelRepository implements EventRepositoryContract
{
    protected static string $modelClass = Event::class;
}
