<x-guest-layout>
    <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Create Your Account</h2>
    
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" class="text-gray-700" />
            <x-text-input id="name" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm" 
                type="text" 
                name="name" 
                :value="old('name')" 
                required 
                autofocus 
                autocomplete="name" 
                placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
            <x-text-input id="email" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autocomplete="username"
                placeholder="your@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-gray-700" />
            
            <x-text-input id="password" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm"
                type="password"
                name="password"
                required 
                autocomplete="new-password"
                placeholder="••••••••" />
            
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <p class="mt-1 text-xs text-gray-500">Must be at least 8 characters</p>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700" />
            
            <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm"
                type="password"
                name="password_confirmation" 
                required 
                autocomplete="new-password"
                placeholder="••••••••" />
            
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full justify-center py-3 bg-blue-600 hover:bg-blue-700 focus:bg-blue-700">
                {{ __('Create Account') }}
            </x-primary-button>
        </div>
        
        <div class="mt-6 text-center text-sm">
            <span class="text-gray-600">Already have an account?</span>
            <a class="text-blue-600 hover:text-blue-800 font-medium ml-1" href="{{ route('login') }}">
                {{ __('Sign in') }}
            </a>
        </div>
        
        <div class="mt-6 pt-4 border-t border-gray-200 text-center text-xs text-gray-500">
            By creating an account, you agree to our
            <a href="#" class="text-blue-600 hover:underline">Terms of Service</a> and
            <a href="#" class="text-blue-600 hover:underline">Privacy Policy</a>
        </div>
    </form>
</x-guest-layout>