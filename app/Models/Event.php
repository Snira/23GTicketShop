<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property string $title
 * @property string $description
 * @property-read Collection&Ticket[] $tickets
 */
class Event extends AbstractModel
{
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function isSoldOut(): bool
    {
        return $this->tickets->where('available', '=', true)->isNotEmpty();
    }
}
