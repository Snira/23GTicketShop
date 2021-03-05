<?php

declare(strict_types=1);

namespace Unit\Factories;

use App\Contracts\Factories\TicketFactory as TicketFactoryContract;
use App\Factories\TicketFactory;
use PHPUnit\Framework\TestCase;

class TicketFactoryTest extends TestCase
{
    private TicketFactoryContract $ticketFactory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->ticketFactory = new TicketFactory();
    }
}
