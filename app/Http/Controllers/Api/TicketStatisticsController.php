<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\TicketStatisticsResource;
use App\Services\TicketStatisticsService;

class TicketStatisticsController extends Controller
{
     public function __construct(
        protected TicketStatisticsService $service
    ) {}

    public function __invoke()
    {
        return new TicketStatisticsResource(
            $this->service->get()
        );
    }
}
