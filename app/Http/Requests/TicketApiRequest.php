<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Contracts\Repositories\EventRepository;
use App\Models\Event;
use Illuminate\Contracts\Validation\Factory as ValidatorFactory;
use Illuminate\Database\Eloquent\Model;

final class TicketApiRequest extends ApiRequest
{
    private EventRepository $eventRepository;

    public function __construct(
        EventRepository $eventRepository,
        ValidatorFactory $validatorFactory,
        array $query = [],
        array $request = [],
        array $attributes = [],
        array $cookies = [],
        array $files = [],
        array $server = [],
        $content = null
    ) {
        parent::__construct($validatorFactory, $query, $request, $attributes, $cookies, $files, $server, $content);

        $this->eventRepository = $eventRepository;
    }

    protected function rules(): array
    {
        return [
            'event_id' => ['bail', 'required', 'int', 'exists:events,id'],
        ];
    }

    /**
     * @return Model&Event
     */
    public function getEvent(): Event
    {
        return $this->eventRepository->find((int)$this->get('event_id'));
    }
}
