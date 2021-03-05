<?php

declare(strict_types=1);

namespace App\Factories;

use App\Contracts\Factories\TicketFactory as TicketFactoryContract;
use App\Models\Event;
use App\Models\Ticket;

final class TicketFactory implements TicketFactoryContract
{
    public function createForEvent(Event $event): Ticket
    {
        $ticket = $this->instantiate();
        $ticket->setEvent($event);

        return $ticket;
    }

    private function instantiate(): Ticket
    {
        return new Ticket();
    }
}
