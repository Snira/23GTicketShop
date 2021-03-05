<?php

declare(strict_types=1);

namespace App\Contracts\Factories;

use App\Models\Event;
use App\Models\Ticket;

interface TicketFactory
{
    public function createForEvent(Event $event): Ticket;
}
