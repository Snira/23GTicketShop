<?php

declare(strict_types=1);

namespace Unit\Repositories;

use App\Contracts\Repositories\TicketRepository as TicketRepositoryContract;
use App\Models\Ticket;
use App\Repositories\TicketRepository;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Collection;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class TicketRepositoryTest extends TestCase
{
    private TicketRepositoryContract $ticketRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $containerMock = $this->createMock(Container::class);
        $this->ticketRepository = new TicketRepository($containerMock);
    }

    public function testSaveMany(): void
    {
        $ticketX = $this->createMock(Ticket::class);
        $ticketY = $this->createMock(Ticket::class);
        $ticketZ = $this->createMock(Ticket::class);

        $tickets = new Collection(
            [
                $ticketX,
                $ticketY,
                $ticketZ,
            ]
        );

        $tickets->each(
            function (MockObject $ticket) {
                $ticket->expects(self::once())
                    ->method('save')
                    ->willReturn(true);
            }
        );

        $this->ticketRepository->saveMany($tickets);
    }
}
