<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdventureTrip;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $query = AdventureTrip::query();

        // Handle search
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        // Handle difficulty filter
        if ($request->has('difficulty') && !empty($request->difficulty)) {
            $query->where('difficulty', $request->difficulty);
        }

        // Handle price range filter
        if ($request->has('price_range') && !empty($request->price_range)) {
            $priceRange = $request->price_range;
            if (strpos($priceRange, '-') !== false) {
                list($min, $max) = explode('-', $priceRange);
                $query->whereBetween('price', [$min, $max]);
            } elseif (strpos($priceRange, '+') !== false) {
                $min = str_replace('+', '', $priceRange);
                $query->where('price', '>=', $min);
            }
        }

        // Get all trips
        $adventureTrips = $query->latest()->get();

        return view('welcome', compact('adventureTrips'));
    }
}