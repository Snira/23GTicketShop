<?php

declare(strict_types=1);

namespace Unit\Factories;

use App\Contracts\Factories\EventFactory as EventFactoryContract;
use App\Factories\EventFactory;
use App\Http\Requests\CreateEventApiRequest;
use PHPUnit\Framework\TestCase;

final class EventFactoryTest extends TestCase
{
    private EventFactoryContract $eventFactory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->eventFactory = new EventFactory();
    }

    public function testCreateForRequest(): void
    {
        $expectedTitle = 'some cool title';
        $expectedDescription = 'some cool description';

        $request = $this->createMock(CreateEventApiRequest::class);
        $request->expects(self::once())
            ->method('getTitle')
            ->willReturn($expectedTitle);
        $request->expects(self::once())
            ->method('getDescription')
            ->willReturn($expectedDescription);


        $event = $this->eventFactory->createForRequest($request);
        self::assertSame($expectedTitle, $event->title);
        self::assertSame($expectedDescription, $event->description);
    }
}
