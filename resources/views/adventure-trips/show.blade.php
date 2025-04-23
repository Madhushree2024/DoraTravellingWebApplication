<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-x-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $trip->name }}
            </h2>
            <a href="{{ route('adventure-trips.index') }}" 
                class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md 
                    font-semibold text-xs text-gray-700 uppercase tracking-widest 
                    hover:bg-gray-300 transition duration-150 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Trips
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="md:col-span-2">
                            <div class="h-64 md:h-96 bg-gray-200 mb-6 rounded-lg overflow-hidden shadow-md">
                                @if ($trip->image_url)
                                    <img src="{{ asset('storage/trips/' . $trip->image_url) }}" alt="{{ $trip->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-100 to-indigo-50">
                                        <svg class="w-24 h-24 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            
                            <h1 class="text-3xl font-bold mb-3 text-gray-800">{{ $trip->name }}</h1>
                            
                            <div class="flex flex-wrap items-center mb-6 gap-y-2">
                                <div class="mr-6 flex items-center">
                                    <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="text-gray-700">{{ $trip->location }}</span>
                                </div>
                                <div class="mr-6 flex items-center">
                                    <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-gray-700">{{ $trip->duration }} days</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                    <span class="capitalize font-medium px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                        {{ App\Models\AdventureTrip::getDifficultyLevels()[$trip->difficulty] }}
                                    </span>
                                </div>
                                
                                @php
                                    $avgRating = $trip->reviews->avg('rating') ?? 0;
                                    $reviewCount = $trip->reviews->count();
                                @endphp
                                <div class="ml-auto flex items-center" title="{{ number_format($avgRating, 1) }} out of 5 stars">
                                    <div class="flex">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="w-5 h-5 {{ $i <= round($avgRating) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @endfor
                                    </div>
                                    <span class="ml-2 text-gray-600">({{ $reviewCount }} {{ Str::plural('review', $reviewCount) }})</span>
                                </div>
                            </div>
                            
                            <div class="prose max-w-none">
                                <h3 class="text-xl font-semibold mb-3 text-gray-800">About this Adventure</h3>
                                <p class="text-gray-700 leading-relaxed">{{ $trip->description }}</p>
                                
                                <!-- Trip Highlights Section -->
                                <div class="mt-8">
                                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Trip Highlights</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        @php
                                            // Simulating trip highlights (You'd need to add these to your database)
                                            $highlights = [
                                                'Professional guides with extensive local knowledge',
                                                'All necessary equipment provided',
                                                'Stunning views and photo opportunities',
                                                'Small groups for personalized experience'
                                            ];
                                        @endphp
                                        @foreach($highlights as $highlight)
                                            <div class="flex items-start">
                                                <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                <span class="text-gray-700">{{ $highlight }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <div class="bg-gray-50 p-6 rounded-lg shadow-sm sticky top-6">
                                <div class="text-center mb-6">
                                    <div class="text-3xl font-bold text-blue-600">₹{{ number_format($trip->price, 2) }}</div>
                                    <div class="text-gray-500">per person</div>
                                </div>
                                
                                <div class="border-t border-b py-4 my-4">
                                    <div class="flex justify-between items-center mb-3">
                                        <span class="font-medium text-gray-700">Difficulty:</span>
                                        <span class="capitalize bg-blue-100 text-blue-800 px-2 py-0.5 rounded-full text-sm">
                                            {{ App\Models\AdventureTrip::getDifficultyLevels()[$trip->difficulty] }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center mb-3">
                                        <span class="font-medium text-gray-700">Duration:</span>
                                        <span class="text-gray-800">{{ $trip->duration }} days</span>
                                    </div>
                                    <div class="flex justify-between items-center mb-3">
                                        <span class="font-medium text-gray-700">Location:</span>
                                        <span class="text-gray-800">{{ $trip->location }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="font-medium text-gray-700">Group Size:</span>
                                        <span class="text-gray-800">4-12 people</span>
                                    </div>
                                </div>
                                
                                <a href="{{ route('bookings.create', $trip) }}" class="block w-full bg-blue-600 text-white text-center py-3 px-4 rounded-md font-semibold hover:bg-blue-700 transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                    Book This Adventure
                                </a>
                                <div class="text-center text-sm text-red-600 mt-3 font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Limited spots available for this trip!
                                </div>
                                
                                <!-- Share Options -->
                                <div class="mt-6 pt-4 border-t">
                                    <div class="font-medium text-gray-700 mb-2">Share this adventure:</div>
                                    <div class="flex justify-center space-x-4">
                                        <button class="text-blue-600 hover:text-blue-800">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"></path>
                                            </svg>
                                        </button>
                                        <button class="text-blue-400 hover:text-blue-600">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723 10.054 10.054 0 01-3.127 1.195 4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.665 2.473c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.937 4.937 0 004.604 3.417 9.868 9.868 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.054 0 13.999-7.496 13.999-13.986 0-.209 0-.42-.015-.63a9.936 9.936 0 002.46-2.548l-.047-.02z"></path>
                                            </svg>
                                        </button>
                                        <button class="text-green-500 hover:text-green-700">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20 3H4a1 1 0 00-1 1v16a1 1 0 001 1h16a1 1 0 001-1V4a1 1 0 00-1-1zM8.339 18.337H5.667v-8.59h2.672v8.59zM7.003 8.574a1.548 1.548 0 110-3.096 1.548 1.548 0 010 3.096zm11.335 9.763h-2.669V14.16c0-.996-.018-2.277-1.388-2.277-1.39 0-1.601 1.086-1.601 2.207v4.248h-2.667v-8.59h2.56v1.174h.037c.355-.675 1.227-1.387 2.524-1.387 2.704 0 3.203 1.778 3.203 4.092v4.71z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Reviews Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800">Reviews & Ratings</h2>
                    
                    <!-- Review Form -->
                    <div class="mb-8 p-6 bg-gray-50 rounded-lg shadow-sm">
                        <h3 class="text-lg font-semibold mb-4 text-gray-800">Share Your Experience</h3>
                        
                        <form action="{{ route('reviews.store', $trip) }}" method="POST" id="reviewForm">
                            @csrf
                            <div class="mb-5">
                                <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">Your Rating</label>
                                <div class="flex items-center">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" class="sr-only" required>
                                        <label for="star{{ $i }}" class="cursor-pointer p-1">
                                            <svg class="w-8 h-8 text-gray-300 hover:text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        </label>
                                    @endfor
                                </div>
                                @error('rating')
                                    <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Your Review</label>
                                <textarea name="content" id="content" rows="4" placeholder="What did you like or dislike about this trip?" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition" required></textarea>
                                @error('content')
                                    <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                                Submit Review
                            </button>
                        </form>
                    </div>
                    
                    <!-- Review List -->
                    <div class="space-y-6">
                        @forelse ($trip->reviews as $review)
                            <div class="border-b pb-6 last:border-b-0">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <div class="font-medium text-gray-800">{{ $review->user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $review->created_at->format('M d, Y') }}</div>
                                    </div>
                                    <div class="flex">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                                @if ($review->content)
                                    <div class="mt-3 text-gray-700 leading-relaxed">{{ $review->content }}</div>
                                @endif
                                
                                @if (Auth::id() === $review->user_id)
                                    <div class="mt-3 flex items-center text-sm">
                                        <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Delete review
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="bg-gray-50 text-gray-600 text-center py-8 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                <p class="mb-2">No reviews yet for this adventure trip.</p>
                                <p>Be the first to share your experience!</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            
        
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Enhanced rating star selection
            const ratingLabels = document.querySelectorAll('[for^="star"]');
            const ratingInputs = document.querySelectorAll('input[name="rating"]');
            
            ratingLabels.forEach(label => {
                label.addEventListener('mouseover', function() {
                    const selectedRating = parseInt(this.getAttribute('for').replace('star', ''));
                    
                    // Highlight stars on hover
                    ratingLabels.forEach((l, index) => {
                        const star = l.querySelector('svg');
                        if (index < selectedRating) {
                            star.classList.remove('text-gray-300');
                            star.classList.add('text-yellow-400');
                        } else {
                            star.classList.remove('text-yellow-400');
                            star.classList.add('text-gray-300');
                        }
                    });
                });
                
                label.addEventListener('click', function() {
                    const selectedRating = parseInt(this.getAttribute('for').replace('star', ''));
                    
                    // Update the actual input value
                    ratingInputs.forEach(input => {
                        if (parseInt(input.value) === selectedRating) {
                            input.checked = true;
                        }
                    });
                });
            });
            
            // Reset stars when moving mouse away from the rating container
            const ratingContainer = document.querySelector('form .flex.items-center');
            ratingContainer.addEventListener('mouseleave', function() {
                // Find the selected rating
                let selectedRating = 0;
                ratingInputs.forEach(input => {
                    if (input.checked) {
                        selectedRating = parseInt(input.value);
                    }
                });
                
                // Reset stars based on the selected rating
                ratingLabels.forEach((l, index) => {
                    const star = l.querySelector('svg');
                    if (index < selectedRating) {
                        star.classList.remove('text-gray-300');
                        star.classList.add('text-yellow-400');
                    } else {
                        star.classList.remove('text-yellow-400');
                        star.classList.add('text-gray-300');
                    }
                });
            });
        });
    </script>
</x-app-layout>