<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;

class TicketController extends Controller
{
      public function store(StoreTicketRequest $request)
    {
         $customer = Customer::firstOrCreate(
        ['email' => $request->email],
        ['name' => $request->name, 'phone' => $request->phone]
    );

        $ticket = $customer->tickets()->create([
        'subject' => $request->subject,
        'text' => $request->text,
        'status' => 'new', 
    ]);

    return new TicketResource($ticket);

    }
}
