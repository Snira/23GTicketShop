<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\Repositories\TicketRepository;
use App\Http\Requests\TicketApiRequest;
use App\Models\Ticket;
use EventFull;
use Illuminate\Contracts\Events\Dispatcher as EventDispatcher;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

final class TicketController extends AbstractApiController
{
    private TicketRepository $ticketRepository;
    private EventDispatcher $eventDispatcher;

    public function __construct(
        EventDispatcher $eventDispatcher,
        ResponseFactory $responseFactory,
        TicketRepository $ticketRepository
    ) {
        parent::__construct($responseFactory);

        $this->eventDispatcher = $eventDispatcher;
        $this->ticketRepository = $ticketRepository;
    }

    public function index(TicketApiRequest $request): JsonResponse
    {
        $tickets = $request->getEvent()->tickets;

        return $this->buildCollectionResponse($tickets);
    }

    public function show(int $ticketId): JsonResponse
    {
        $ticket = $this->ticketRepository->find($ticketId);

        return $this->responseFactory->json($ticket->toArray(), Response::HTTP_OK);
    }

    public function buyTicket(int $ticketId): JsonResponse
    {
        $ticket = $this->ticketRepository->find($ticketId);

        /** @var Ticket $ticket */
        $ticket->available = false;

        $this->ticketRepository->save($ticket);

        if ($ticket->event->isSoldOut()) {
            $this->eventDispatcher->dispatch(new EventFull($ticket->event));
        }

        return $this->responseFactory->json(['feedback' => 'Success'], Response::HTTP_OK);
    }
}
