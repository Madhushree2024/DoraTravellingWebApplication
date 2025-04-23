<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\AdventureTrip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, AdventureTrip $adventureTrip)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);
        
        $review = new Review([
            'content' => $validated['content'],
            'rating' => $validated['rating'],
            'adventure_trip_id' => $adventureTrip->id,
            'user_id' => Auth::id()
        ]);
        
        $review->save();
        
        return redirect()->back()->with('success', 'Review submitted successfully!');
    }
    
    public function destroy(Review $review)
    {
        // Authorization check - only allow users to delete their own reviews
        if (Auth::id() !== $review->user_id) {
            return abort(403);
        }
        
        $review->delete();
        
        return redirect()->back()->with('success', 'Review deleted successfully!');
    }

    public function myReviews()
{
    $reviews = Review::where('user_id', Auth::id())
        ->with('adventureTrip')
        ->orderBy('created_at', 'desc')
        ->paginate(10);
    
    return view('reviews.my-reviews', compact('reviews'));
}
}