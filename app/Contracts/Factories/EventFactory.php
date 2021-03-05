<?php

declare(strict_types=1);

namespace App\Contracts\Factories;

use App\Http\Requests\CreateEventApiRequest;
use App\Models\Event;

interface EventFactory
{
    public function createForRequest(CreateEventApiRequest $request): Event;
}
