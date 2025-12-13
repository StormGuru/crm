<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\TicketStatus;
use Illuminate\Database\Eloquent\Builder;


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

    public function scopeToday(Builder $query): Builder
    {
        return $query->whereDate('created_at', now());
    }

     public function scopeThisWeek(Builder $query)
    {
        return $query->where('created_at', '>=', now()->startOfWeek());
    }

    public function scopeThisMonth(Builder $query)
    {
        return $query->where('created_at', '>=', now()->startOfMonth());
    }


     protected $casts = [
        'status' => TicketStatus::class, 
        'replied_at' => 'datetime',      
    ];
}
