<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\TicketStatus;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Carbon\Carbon;


class Ticket extends Model implements HasMedia
{
     use HasFactory, InteractsWithMedia; 

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
    return $query->whereDate('created_at', Carbon::today());
   }

    public function scopeThisWeek(Builder $query): Builder
   {
    return $query->whereBetween(
        'created_at',
        [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
    );
   }

    public function scopeThisMonth(Builder $query): Builder
   {
    return $query->whereMonth('created_at', Carbon::now()->month)
                 ->whereYear('created_at', Carbon::now()->year);
   }


     protected $casts = [
        'status' => TicketStatus::class, 
        'replied_at' => 'datetime',      
    ];

    public function registerMediaCollections(): void
   {
    $this->addMediaCollection('attachments');
   }
}
