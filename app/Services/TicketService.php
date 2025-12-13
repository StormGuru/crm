<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Ticket;

class TicketService
{
    public function create(array $data): Ticket
    {
        $customer = Customer::firstOrCreate(
            ['email' => $data['email']],
            [
                
             'name'  => $data['name'],
             'phone' => $data['phone'],
            ]
        );

        return $customer->tickets()->create([
            'subject' => $data['subject'],
            'text'    => $data['text'],
            'status'  => 'new',
        ]);
    }
}
