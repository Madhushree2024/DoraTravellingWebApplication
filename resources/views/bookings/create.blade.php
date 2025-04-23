<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-x-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Book Trip') }}: <span class="text-blue-600">{{ $trip->name }}</span>
            </h2>
            <a href="{{ route('adventure-trips.show', $trip) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 transition duration-150 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Trip Details
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="md:col-span-2">
                            <h3 class="text-lg font-semibold mb-6 pb-2 border-b">Complete Your Booking</h3>
                            
                            <form action="{{ route('bookings.store', $trip) }}" method="POST">
                                @csrf
                                
                                <div class="mb-6">
                                    <label for="booking_date" class="block text-sm font-medium text-gray-700 mb-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        When do you want to go?
                                    </label>
                                    <input type="date" name="booking_date" id="booking_date" 
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition" 
                                        min="{{ date('Y-m-d', strtotime('+1 day')) }}" 
                                        required>
                                    @error('booking_date')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="mb-8">
                                    <label for="number_of_travelers" class="block text-sm font-medium text-gray-700 mb-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        Number of Travelers
                                    </label>
                                    <select name="number_of_travelers" id="number_of_travelers" 
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition" 
                                        required>
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}">{{ $i }} {{ $i === 1 ? 'person' : 'people' }}</option>
                                        @endfor
                                    </select>
                                    @error('number_of_travelers')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="border-t pt-6">
                                    <button type="submit" class="w-full md:w-auto bg-blue-600 text-white py-3 px-8 rounded-md font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-150 ease-in-out">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Confirm Booking
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        <div class="bg-gray-50 p-6 rounded-lg shadow-inner">
                            <h4 class="font-semibold mb-4 pb-2 border-b border-gray-200">Trip Summary</h4>
                            
                            @if ($trip->image)
                                <img src="{{ $trip->image }}" alt="{{ $trip->name }}" class="w-full h-40 object-cover rounded mb-4">
                            @endif
                            
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-gray-600">Trip:</span>
                                <span class="font-medium">{{ $trip->name }}</span>
                            </div>
                            
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-gray-600">Duration:</span>
                                <span>{{ $trip->duration }} days</span>
                            </div>
                            
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-gray-600">Location:</span>
                                <span>{{ $trip->location }}</span>
                            </div>
                            
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-gray-600">Difficulty:</span>
                                <span class="capitalize">{{ App\Models\AdventureTrip::getDifficultyLevels()[$trip->difficulty] }}</span>
                            </div>
                            
                            <div class="border-t mt-4 pt-4">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-medium text-gray-600">Price per person:</span>
                                    <span class="text-blue-600 font-medium">₹{{ number_format($trip->price, 2) }}</span>
                                </div>
                                
                                <div class="flex justify-between items-center text-lg font-bold mt-3 pt-3 border-t border-gray-300">
                                    <span>Total (<span id="traveler-count">1</span> travelers):</span>
                                    <span id="total-price" class="text-blue-700">₹{{ number_format($trip->price, 2) }}</span>
                                </div>
                            </div>
                            
                            <div class="mt-6 p-4 bg-blue-50 rounded text-sm text-gray-600 border border-blue-100">
                                <h5 class="font-semibold text-blue-800 mb-2">Important Information</h5>
                                <ul class="space-y-2">
                                    <li class="flex items-start">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500 mr-1 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Booking can be cancelled up to 48 hours before the trip.
                                    </li>
                                    <li class="flex items-start">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500 mr-1 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                        </svg>
                                        Payment will be collected at checkout.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Update the total price based on number of travelers
        document.addEventListener('DOMContentLoaded', function() {
            const numberSelect = document.getElementById('number_of_travelers');
            const travelerCount = document.getElementById('traveler-count');
            const totalPrice = document.getElementById('total-price');
            const pricePerPerson = {{ $trip->price }};
            
            numberSelect.addEventListener('change', function() {
                const numberOfTravelers = parseInt(this.value);
                travelerCount.textContent = numberOfTravelers;
                
                const total = (numberOfTravelers * pricePerPerson).toFixed(2);
                totalPrice.textContent = '$' + new Intl.NumberFormat().format(total);
            });
        });
    </script>
</x-app-layout>