<?php

declare(strict_types=1);

use Illuminate\Contracts\Mail\Mailer;

/**
 * @see EventFull
 */
final class SendEventFullMailListener
{
    private Mailer $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function handle(EventFull $event): void
    {
        $eventModel = $event->getEvent();

        $this->mailer->send(new EventSoldOutMail($eventModel));
    }
}
