<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Http\Requests\UpdateTicketStatusRequest;
use App\Services\TicketService;
use App\Enums\TicketStatus;

class TicketController extends Controller
{

    public function __construct(TicketService $ticketService)
    {
      $this->ticketService = $ticketService;
    }

    public function index(Request $request)
    {
      
       $tickets = $this->ticketService->getFilteredTickets($request);

       return view('admin.tickets.index', compact('tickets'));

    }

   
    public function show(Ticket $ticket)
    {
        $ticket->load('customer'); 
        return view('admin.tickets.show', compact('ticket'));
    }

   

   public function updateStatus(
        UpdateTicketStatusRequest $request,
        Ticket $ticket
    ) {
       //dd($request->status);
        
       $statusEnum = TicketStatus::from($request->status);
      
        $this->ticketService->updateStatus(
            $ticket,
            $statusEnum
        );

        return redirect()
            ->back()
            ->with('success', 'Статус обновлён');
    }


}
