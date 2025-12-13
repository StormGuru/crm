<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function index(Request $request)
    {
      $query = Ticket::with('customer');

    $query->when($request->status, fn ($q) =>
        $q->where('status', $request->status)
    );

    $query->when($request->date, fn ($q) =>
        $q->whereDate('created_at', $request->date)
    );

    $query->when(
        $request->email,
        fn ($q) =>
            $q->whereHas('customer', fn ($c) =>
                $c->where('email', 'like', "%{$request->email}%")
            )
    );

    $query->when(
        $request->phone,
        fn ($q) =>
            $q->whereHas('customer', fn ($c) =>
                $c->where('phone', 'like', "%{$request->phone}%")
            )
    );

    $tickets = $query->latest()->get();

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
