<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded mb-4 shadow-sm flex items-center">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Hero Section -->
            <div class="relative mb-6 bg-gradient-to-r from-blue-600 to-indigo-700 rounded-lg shadow-lg overflow-hidden">
                <div class="absolute inset-0 bg-black opacity-20"></div>
                <div class="relative z-10 p-6 sm:p-10 text-white">
                    <h1 class="text-2xl sm:text-3xl font-bold mb-2">Discover Your Next Adventure</h1>
                    <p class="max-w-xl mb-6">Experience thrilling adventures in breathtaking locations around the world. Book your adventure today and create memories that last a lifetime.</p>
                    <a href="#trips" class="inline-flex items-center px-6 py-3 bg-white text-blue-700 rounded-md font-semibold text-sm hover:bg-gray-100 transition duration-150">
                        Browse Trips
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Filter Card -->
            <div class="mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">Filter Adventure Trips</h3>
                        <button id="toggleFilters" class="text-blue-600 hover:text-blue-800 flex items-center text-sm font-medium focus:outline-none">
                            <span id="toggleText">Hide Filters</span>
                            <svg id="toggleIcon" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 transform rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </div>
                    <div id="filterForm" class="transition-all duration-300 ease-in-out">
                        <form action="{{ route('adventure-trips.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div>
                                <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" name="location" id="location" placeholder="Any location" value="{{ request('location') }}" class="w-full rounded-md border-gray-300 pl-10 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                </div>
                            </div>
                            <div>
                                <label for="difficulty" class="block text-sm font-medium text-gray-700 mb-1">Difficulty</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                    </div>
                                    <select name="difficulty" id="difficulty" class="w-full rounded-md border-gray-300 pl-10 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <option value="">Any difficulty</option>
                                        @foreach ($difficultyLevels as $value => $label)
                                            <option value="{{ $value }}" {{ request('difficulty') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label for="price_range" class="block text-sm font-medium text-gray-700 mb-1">Price Range</label>
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500">₹</span>
                                        </div>
                                        <input type="number" name="price_min" id="price_min" placeholder="Min" value="{{ request('price_min') }}" class="w-full rounded-md border-gray-300 pl-8 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    </div>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500">₹</span>
                                        </div>
                                        <input type="number" name="price_max" id="price_max" placeholder="Max" value="{{ request('price_max') }}" class="w-full rounded-md border-gray-300 pl-8 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="sort_by" class="block text-sm font-medium text-gray-700 mb-1">Sort By</label>
                                <div class="grid grid-cols-2 gap-2">
                                    <select name="sort_by" id="sort_by" class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <option value="price" {{ request('sort_by') == 'price' ? 'selected' : '' }}>Price</option>
                                        <option value="created_at" {{ request('sort_by') == 'created_at' || !request('sort_by') ? 'selected' : '' }}>Newest</option>
                                        <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Name</option>
                                        <option value="rating" {{ request('sort_by') == 'rating' ? 'selected' : '' }}>Rating</option>
                                    </select>
                                    <select name="sort_direction" id="sort_direction" class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <option value="asc" {{ request('sort_direction') == 'asc' ? 'selected' : '' }}>Ascending</option>
                                        <option value="desc" {{ request('sort_direction') == 'desc' || !request('sort_direction') ? 'selected' : '' }}>Descending</option>
                                    </select>
                                </div>
                            </div>
                            <div class="md:col-span-4 flex justify-end space-x-3">
                                <a href="{{ route('adventure-trips.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Reset
                                </a>
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                    </svg>
                                    Apply Filters
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Trip Count & Active Filters -->
            <div class="mb-4 flex flex-wrap items-center justify-between">
                <div class="mb-2 sm:mb-0">
                    <p class="text-gray-600">Showing <span class="font-semibold">{{ $trips->count() }}</span> of <span class="font-semibold">{{ $trips->total() }}</span> trips</p>
                </div>
                
                @if(request()->anyFilled(['location', 'difficulty', 'price_min', 'price_max']))
                    <div class="flex flex-wrap gap-2">
                        @if(request('location'))
                            <div class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                <span>Location: {{ request('location') }}</span>
                                <a href="{{ route('adventure-trips.index', request()->except('location')) }}" class="ml-2 text-blue-500 hover:text-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </a>
                            </div>
                        @endif
                        
                        @if(request('difficulty'))
                            <div class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                <span>Difficulty: {{ $difficultyLevels[request('difficulty')] }}</span>
                                <a href="{{ route('adventure-trips.index', request()->except('difficulty')) }}" class="ml-2 text-blue-500 hover:text-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </a>
                            </div>
                        @endif
                        
                        @if(request('price_min') || request('price_max'))
                            <div class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                <span>Price: 
                                    @if(request('price_min') && request('price_max'))
                                        ${{ request('price_min') }} - ${{ request('price_max') }}
                                    @elseif(request('price_min'))
                                        ${{ request('price_min') }}+
                                    @else
                                        Up to ${{ request('price_max') }}
                                    @endif
                                </span>
                                <a href="{{ route('adventure-trips.index', request()->except(['price_min', 'price_max'])) }}" class="ml-2 text-blue-500 hover:text-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </a>
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Trips Grid -->
            <div id="trips" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($trips as $trip)
                <div class="bg-white dark:bg-gray-800 border border-blue-100 dark:border-blue-900/30 rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 transform hover:-translate-y-1 group">
                <div class="h-48 bg-gray-200 dark:bg-gray-700 relative overflow-hidden">
                            @if ($trip->image_url)
                                <img src="{{ asset('storage/trips/' . $trip->image_url) }}" alt="{{ $trip->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @else
                            <div class="w-full h-full flex items-center justify-center bg-blue-50 dark:bg-blue-900/20 group-hover:bg-blue-100 dark:group-hover:bg-blue-900/30 transition-colors duration-500">
                                    <svg class="w-16 h-16 text-blue-400 dark:text-blue-500 transition-all duration-500 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute top-2 right-2 bg-blue-600 text-white px-2 py-1 rounded-full text-xs font-bold">
                                {{ $difficultyLevels[$trip->difficulty] }}
                            </div>
                            <div class="absolute bottom-2 right-2 bg-green-600 text-white px-2 py-1 rounded-full text-sm font-bold">
                            ₹{{ number_format($trip->price) }}
                            </div>
                            <div class="absolute bottom-2 left-2 bg-gray-800 bg-opacity-75 text-white px-2 py-1 rounded-full text-xs">
                                {{ $trip->duration }} days
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-lg font-semibold text-gray-900 hover:text-blue-600">
                                    <a href="{{ route('adventure-trips.show', $trip) }}" class="hover:underline">{{ $trip->name }}</a>
                                </h3>
                            </div>
                            <div class="flex items-center mb-2">
                                <svg class="w-4 h-4 text-gray-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="text-gray-700">{{ $trip->location }}</span>
                            </div>
                            <p class="text-gray-600 mb-4 line-clamp-2">{{ $trip->description }}</p>
                            
                            <div class="flex items-center mb-4">
                                @php
                                    $avgRating = $trip->reviews->avg('rating') ?? 0;
                                    $reviewCount = $trip->reviews->count();
                                @endphp
                                <div class="flex mr-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= round($avgRating) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @endfor
                                </div>
                                <span class="text-xs text-gray-500">
                                    @if($reviewCount > 0)
                                        {{ number_format($avgRating, 1) }} ({{ $reviewCount }} {{ Str::plural('review', $reviewCount) }})
                                    @else
                                        No reviews yet
                                    @endif
                                </span>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <a href="{{ route('adventure-trips.show', $trip) }}" class="inline-flex items-center px-3 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    View Details
                                </a>
                                <a href="{{ route('bookings.create', $trip) }}" class="inline-flex items-center px-3 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="md:col-span-3 bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 text-center">
                        <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-gray-500 text-lg mb-4">No adventure trips found matching your filters.</p>
                        <a href="{{ route('adventure-trips.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Reset filters
                        </a>
                    </div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            <div class="mt-6">
                {{ $trips->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    <script>
        // Toggle filter form visibility
        document.addEventListener('DOMContentLoaded', function() {
            const toggleFilters = document.getElementById('toggleFilters');
            const filterForm = document.getElementById('filterForm');
            const toggleText = document.getElementById('toggleText');
            const toggleIcon = document.getElementById('toggleIcon');

            toggleFilters.addEventListener('click', function() {
                filterForm.classList.toggle('hidden');
                
                if (filterForm.classList.contains('hidden')) {
                    toggleText.textContent = 'Show Filters';
                    toggleIcon.classList.remove('rotate-180');
                } else {
                    toggleText.textContent = 'Hide Filters';
                    toggleIcon.classList.add('rotate-180');
                }
            });

            // Stars Animation on Hover
            const tripCards = document.querySelectorAll('.bg-white.overflow-hidden.shadow-sm.sm\\:rounded-lg');
            tripCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.querySelector('h3').classList.add('text-blue-600');
                });
                
                card.addEventListener('mouseleave', function() {
                    this.querySelector('h3').classList.remove('text-blue-600');
                });
            });
        });
    </script>
</x-app-layout>