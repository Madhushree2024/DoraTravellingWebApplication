<?php

namespace App\Http\Controllers;

use App\Models\AdventureTrip;
use Illuminate\Http\Request;

class AdventureTripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = AdventureTrip::query();
    
        // Apply filters only if they have actual values
        if ($request->filled('location')) {
            $query->whereRaw('LOWER(location) LIKE ?', ['%' . strtolower($request->location) . '%']);
        }
    
        if ($request->filled('difficulty')) {
            $query->where('difficulty', $request->difficulty);
        }
    
        // Improved price range filtering
        if ($request->filled('price_min') && $request->filled('price_max')) {
            $query->whereBetween('price', [(float)$request->price_min, (float)$request->price_max]);
        } elseif ($request->filled('price_min')) {
            $query->where('price', '>=', (float)$request->price_min);
        } elseif ($request->filled('price_max')) {
            $query->where('price', '<=', (float)$request->price_max);
        }
    
        // Apply sorting
        $sortField = $request->get('sort_by', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc');
        $query->orderBy($sortField, $sortDirection);
    
        // Debug what's happening with the query
        \Log::info('SQL Query: ' . $query->toSql());
        \Log::info('Query Bindings: ', $query->getBindings());
    
        $trips = $query->with('reviews')->paginate(9);
    
        return view('adventure-trips.index', [
            'trips' => $trips,
            'difficultyLevels' => AdventureTrip::getDifficultyLevels(),
            'filters' => $request->only(['location', 'difficulty', 'price_min', 'price_max', 'sort_by', 'sort_direction'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adventure-trips.create', [
            'difficultyLevels' => AdventureTrip::getDifficultyLevels()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'difficulty' => 'required|string|in:' . implode(',', array_keys(AdventureTrip::getDifficultyLevels())),
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'image_url' => 'nullable|url',
        ]);

        AdventureTrip::create($validated);

        return redirect()->route('adventure-trips.index')->with('success', 'Trip created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(AdventureTrip $adventureTrip)
    {
        $adventureTrip->load('reviews.user');
        return view('adventure-trips.show', [
            'trip' => $adventureTrip
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdventureTrip $adventureTrip)
    {
        return view('adventure-trips.edit', [
            'trip' => $adventureTrip,
            'difficultyLevels' => AdventureTrip::getDifficultyLevels()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdventureTrip $adventureTrip)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'difficulty' => 'required|string|in:' . implode(',', array_keys(AdventureTrip::getDifficultyLevels())),
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'image_url' => 'nullable|url',
        ]);

        $adventureTrip->update($validated);

        return redirect()->route('adventure-trips.index')->with('success', 'Trip updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdventureTrip $adventureTrip)
    {
        $adventureTrip->delete();

        return redirect()->route('adventure-trips.index')->with('success', 'Trip deleted successfully!');
    }
}