<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use App\Services\TicketService;


class TicketController extends Controller
{
    public function __construct(
        protected TicketService $ticketService
    ) {}

    public function store(StoreTicketRequest $request)
    {
        $ticket = $this->ticketService->create(
            $request->validated()
        );

        return new TicketResource($ticket);
    } 
}
