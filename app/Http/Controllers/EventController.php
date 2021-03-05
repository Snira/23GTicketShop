<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\Factories\EventFactory;
use App\Contracts\Factories\TicketFactory;
use App\Contracts\Repositories\EventRepository;
use App\Contracts\Repositories\TicketRepository;
use App\Http\Requests\ApiRequest;
use App\Http\Requests\CreateEventApiRequest;
use App\Models\Event;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

final class EventController extends AbstractApiController
{
    private EventFactory $eventFactory;
    private EventRepository $eventRepository;
    private TicketFactory $ticketFactory;
    private TicketRepository $ticketRepository;

    public function __construct(
        EventFactory $eventFactory,
        EventRepository $eventRepository,
        ResponseFactory $responseFactory,
        TicketFactory $ticketFactory,
        TicketRepository $ticketRepository
    ) {
        parent::__construct($responseFactory);

        $this->eventFactory = $eventFactory;
        $this->eventRepository = $eventRepository;
        $this->ticketFactory = $ticketFactory;
        $this->ticketRepository = $ticketRepository;
    }

    public function index(ApiRequest $request): JsonResponse
    {
        $events = $this->eventRepository->paginate($request->getPerPage(), $request->getPage());

        return $this->buildPaginatedResponse($events);
    }

    public function store(CreateEventApiRequest $request): JsonResponse
    {
        $event = $this->eventFactory->createForRequest($request);
        $this->eventRepository->save($event);

        $this->addTickets($event, $request->getTicketAmount());

        return $this->responseFactory->json(['feedback' => 'Success'], Response::HTTP_CREATED);
    }

    private function addTickets(Event $event, int $ticketAmount): void
    {
        $tickets = new Collection();

        for ($x = 1; $x <= $ticketAmount; $x++) {
            $tickets->push($this->ticketFactory->createForEvent($event));
        }

        $this->ticketRepository->saveMany($tickets);
    }
}
