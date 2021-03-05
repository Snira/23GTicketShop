<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\EloquentAttributeDataType as T;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $event_id
 * @property bool $available
 * @property-read Event $event
 */
class Ticket extends AbstractModel
{
    /** @var array<string, string> */
    protected $casts = [
        'available' => T::BOOLEAN,
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function setEvent(Event $event): void
    {
        $this->event()->associate($event);
    }
}
