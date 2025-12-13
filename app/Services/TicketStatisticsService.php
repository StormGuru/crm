<?php

namespace App\Services;
use App\Models\Ticket;

class TicketStatisticsService
{
    /**
     * Create a new class instance.
     */
     public function get(): array
    {
        return [
            'today' => Ticket::today()->count(),
            'week'  => Ticket::thisWeek()->count(),
            'month' => Ticket::thisMonth()->count(),
        ];
    }
}
