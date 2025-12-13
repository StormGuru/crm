<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
      public function index()
    {
        $tickets = Ticket::with('customer')->latest()->get();  
        return view('admin.tickets.index', compact('tickets'));
    }

   
    public function show(Ticket $ticket)
    {
        $ticket->load('customer'); 
        return view('admin.tickets.show', compact('ticket'));
    }

   
    public function updateStatus(Request $request, Ticket $ticket)
  {
    $request->validate([
        'status' => 'required|string',
    ]);

    $ticket->status = $request->status;
    $ticket->save();

    return redirect()->back()->with('success', 'Статус обновлён');
  }
  
}
