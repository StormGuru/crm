<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Ticket;
use App\Enums\TicketStatus;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;


class TicketService
{
    public function create(array $data): Ticket
    {
         $exists = Ticket::whereDate('created_at', Carbon::today())
        ->whereHas('customer', function($query) use ($data) {
            $query->where('email', $data['email'])
                  ->orWhere('phone', $data['phone']);
        })
        ->exists();

        if ($exists) {
        throw ValidationException::withMessages([
            'email' => 'Вы уже отправляли заявку сегодня с этим email или номером телефона.',
          ]);
        }

        $customer = $this->findOrCreateCustomer($data);

        $ticket = Ticket::create([
            'customer_id' => $customer->id,
            'subject'     => $data['subject'],
            'text'        => $data['text'],
            'status'      => TicketStatus::NEW,
        ]);

        if (!empty($data['files'])) {
            foreach ($data['files'] as $file) {
                $ticket
                    ->addMedia($file)
                    ->toMediaCollection('attachments');
            }
        }

        return $ticket;
    }

    private function findOrCreateCustomer(array $data): Customer
    {
        return Customer::firstOrCreate(
            ['email' => $data['email']],
            [
                'name'  => $data['name'],
                'phone' => $data['phone'],
            ]
        );
    }

   public function updateStatus(Ticket $ticket, TicketStatus $status): Ticket
    {
    if ($status === TicketStatus::DONE && $ticket->replied_at === null) {
        $ticket->replied_at = now();
    }

    $ticket->status = $status->value;
    $ticket->save();

    return $ticket;

    }

    public function getFilteredTickets(Request $request): Collection
    {

     $query = Ticket::with('customer');

     $query->when($request->status, fn ($q) =>
        $q->where('status', $request->status)
     );

     $query->when($request->date, fn ($q) =>
        $q->whereDate('created_at', $request->date)
    );

     $query->when($request->email, fn ($q) =>
        $q->whereHas('customer', fn ($c) =>
            $c->where('email', 'like', "%{$request->email}%")
        )
    );

     $query->when($request->phone, fn ($q) =>
        $q->whereHas('customer', fn ($c) =>
            $c->where('phone', 'like', "%{$request->phone}%")
        )
    );

     return $query->latest()->get();
   }
}
