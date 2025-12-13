<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Ticket; 
use App\Http\Resources\CustomerResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
         return [
            'id'          => $this->id,
            'customer' => new CustomerResource($this->customer),
            'subject'     => $this->subject,
            'text'        => $this->text,
            'status'      => $this->status,
            'replied_at'  => $this->replied_at?->format('Y-m-d H:i'), 
            'created_at'  => $this->created_at->format('Y-m-d H:i'),
        ];
    }
}
