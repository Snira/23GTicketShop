<?php

declare(strict_types=1);

namespace App\Factories;

use App\Contracts\Factories\EventFactory as EventFactoryContract;
use App\Http\Requests\CreateEventApiRequest;
use App\Models\Event;

final class EventFactory implements EventFactoryContract
{
    public function createForRequest(CreateEventApiRequest $request): Event
    {
        $event = $this->instantiate();
        $event->title = $request->getTitle();
        $event->description = $request->getDescription();

        return $event;
    }

    private function instantiate(): Event
    {
        return new Event();
    }
}
