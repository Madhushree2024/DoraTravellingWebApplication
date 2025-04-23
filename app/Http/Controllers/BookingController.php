<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\AdventureTrip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Show booking form
     */
    public function create(AdventureTrip $adventureTrip)
    {
        return view('bookings.create', [
            'trip' => $adventureTrip
        ]);
    }

    /**
     * Store a booking
     */
    public function store(Request $request, AdventureTrip $adventureTrip)
    {
        $validated = $request->validate([
            'booking_date' => 'required|date|after:today',
            'number_of_travelers' => 'required|integer|min:1',
        ]);

        // Calculate total price
        $totalPrice = $adventureTrip->price * $validated['number_of_travelers'];

        // Create booking
        Booking::create([
            'adventure_trip_id' => $adventureTrip->id,
            'user_id' => Auth::id(),
            'booking_date' => $validated['booking_date'],
            'number_of_travelers' => $validated['number_of_travelers'],
            'total_price' => $totalPrice,
            'status' => Booking::STATUS_PENDING,
        ]);

        return redirect()->route('adventure-trips.show', $adventureTrip)
            ->with('success', 'Booking created successfully! Check your bookings for details.');
    }

    /**
     * View user's bookings
     */
    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with('adventureTrip')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('bookings.index', [
            'bookings' => $bookings
        ]);
    }

    /**
     * Cancel a booking
     */
    public function cancel(Booking $booking)
    {
        // Ensure the booking belongs to the authenticated user
        if ($booking->user_id !== Auth::id()) {
            return redirect()->route('bookings.index')
                ->with('error', 'Unauthorized action.');
        }

        $booking->update(['status' => Booking::STATUS_CANCELLED]);

        return redirect()->route('bookings.index')
            ->with('success', 'Booking cancelled successfully.');
    }
}