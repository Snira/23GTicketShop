<?php

declare(strict_types=1);


use App\Models\Event;
use Illuminate\Contracts\Database\ModelIdentifier;
use Illuminate\Queue\SerializesModels;

/**
 * @see SendEventFullMailListener
 */
final class EventFull
{
    use SerializesModels;

    /** @var Event&ModelIdentifier */
    private $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function getEvent(): Event
    {
        return $this->event;
    }
}
