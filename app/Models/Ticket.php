<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Customer;
use App\Enums\TicketStatus;

class Ticket extends Model
{
     use HasFactory; 

     protected $fillable = [
        'customer_id',
        'subject',
        'text',
        'status',
        'replied_at'
    ];

     public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

     protected $casts = [
        'status' => TicketStatus::class, 
        'replied_at' => 'datetime',      
    ];
}
