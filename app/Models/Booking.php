<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'adventure_trip_id',
        'user_id',
        'booking_date',
        'number_of_travelers',
        'total_price',
        'status',
    ];

    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_CANCELLED = 'cancelled';

    // Adventure trip relationship
    public function adventureTrip()
    {
        return $this->belongsTo(AdventureTrip::class);
    }

    // User relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'booking_date' => 'datetime',
    ];
}