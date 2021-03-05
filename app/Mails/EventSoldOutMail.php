<?php

declare(strict_types=1);

use App\Models\Event;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Mail\Mailable;

final class EventSoldOutMail extends Mailable
{
    private Event $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function build(Translator $translator): self
    {
        return $this
            ->to($this->event->soldToUser) //TODO
            ->view('mails.event_sold_out_mail')
            ->subject($translator->get('mails.' . self::class . '.subject', ['title' => $this->event->title]))
            ->with(
                [
                    'translations' => 'mails.' . self::class,
                ],
            );
    }
}
