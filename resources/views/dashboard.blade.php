<x-app-layout>

    <div class="py-12 bg-gradient-to-b from-blue-100 to-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold mb-4">Welcome to Adventure Trips!</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-6 rounded-lg shadow-lg text-white">
                                <h3 class="text-xl font-bold mb-3">Search for the best adventure trips!</h3>
                                <p class="mb-2">Sort by location, difficulty, and budget!</p>
                                <p class="mb-2">Read reviews from other travelers!</p>
                                <p class="mb-4">Book instantly—before Swiper swipes the best deals!</p>
                                <a href="{{ route('adventure-trips.index') }}" class="inline-block bg-white text-purple-600 px-4 py-2 rounded-md font-semibold hover:bg-gray-100 transition">Start Exploring</a>
                            </div>
                            <div class="bg-white p-6 border rounded-lg shadow-lg">
                                <h3 class="text-xl font-bold mb-3 text-gray-800">Quick Search</h3>
                                <form action="{{ route('adventure-trips.index') }}" method="GET" class="space-y-4">
                                    <div>
                                        <label for="location" class="block text-gray-700 mb-1">Location</label>
                                        <input type="text" name="location" id="location" placeholder="Where do you want to go?" class="w-full px-3 py-2 border rounded-md">
                                    </div>
                                    <div>
                                        <label for="difficulty" class="block text-gray-700 mb-1">Difficulty</label>
                                        <select name="difficulty" id="difficulty" class="w-full px-3 py-2 border rounded-md">
                                            <option value="">Any difficulty</option>
                                            @foreach (App\Models\AdventureTrip::getDifficultyLevels() as $value => $label)
                                                <option value="{{ $value }}">{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label for="price_min" class="block text-gray-700 mb-1">Min Budget</label>
                                            <input type="number" name="price_min" id="price_min" placeholder="Min ₹" class="w-full px-3 py-2 border rounded-md">
                                        </div>
                                        <div>
                                            <label for="price_max" class="block text-gray-700 mb-1">Max Budget</label>
                                            <input type="number" name="price_max" id="price_max" placeholder="Max ₹" class="w-full px-3 py-2 border rounded-md">
                                        </div>
                                    </div>
                                    <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md font-semibold hover:bg-blue-700 transition">Search Trips</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="border-t pt-6">
                        <h3 class="text-lg font-semibold mb-4">Your Recent Activity</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="border border-blue-150 bg-gradient-to-r from-blue-200 to-blue-50 rounded-lg p-4 shadow-md">
                                <h4 class="font-medium text-gray-700 mb-2">Your Bookings</h4>
                                @if (Auth::user()->bookings()->count() > 0)
                                    <ul class="space-y-2">
                                    @foreach (Auth::user()->bookings() as $booking)
                                        <li class="flex justify-between items-center">
                                            <span>{{ $booking->adventureTrip->name }}</span>
                                            <span class="text-sm text-gray-500">
                                                <!-- If it's a date you're trying to format -->
                                                {{ $booking->created_at instanceof \DateTime ? $booking->created_at->format('d M Y') : $booking->created_at }}
                                                
                                                <!-- Or if it's a price you're trying to format -->
                                                ₹{{ is_numeric($booking->adventureTrip->price) ? number_format($booking->adventureTrip->price) : $booking->adventureTrip->price }}
                                            </span>
                                        </li>
                                    @endforeach
                                    </ul>
                                    <a href="{{ route('bookings.index') }}" class="text-blue-600 text-sm block mt-3 hover:underline">View all bookings</a>
                                @else
                                    <p class="text-gray-500 text-sm">You haven't booked any trips yet.</p>
                                    <a href="{{ route('adventure-trips.index') }}" class="text-blue-600 text-sm block mt-2 hover:underline">Explore trips</a>
                                @endif
                            </div>
                            
                            <div class="border border-blue-150 bg-gradient-to-r from-blue-50 to-blue-200 rounded-lg p-4 shadow-md">
                                <h4 class="font-medium text-gray-700 mb-2">Your Reviews</h4>
                                @if (Auth::user()->reviews()->count() > 0)
                                    <ul class="space-y-2">
                                        @foreach (Auth::user()->reviews()->latest()->take(3)->get() as $review)
                                            <li class="flex justify-between items-center">
                                                <span>{{ $review->adventureTrip->name }}</span>
                                                <div class="flex items-center">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                        </svg>
                                                    @endfor
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-gray-500 text-sm">You haven't reviewed any trips yet.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>