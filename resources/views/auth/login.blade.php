<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
           <img src="{{ asset('assets/images/logo (2).png') }}" alt="logo" class="w-16 h-16 mx-auto" class="">
            
        </x-slot>
        <div class="w-full flex items-center justify-center font-bold text-xl mt-2 text-[#404059]">

            Login To Continue
        </div>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <div class="block mt-4 flex items-center justify-between">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>


            <div class="flex items-center flex-col justify-end mt-4 gap-2">

                <x-button class="ms-4  w-full">
                    {{ __('Log in') }}
                </x-button>

            </div>

            <div class="flex justify-center py-5">
                <p class="text-sm">Dont have an account ? <a
                        class="underline text-sm hover:font-bold text-gray-600 hover:text-blue-900 rounded-md focus:outline-none focus:ring-none"
                        href="{{ route('register') }}">
                        {{ __('Create An Account ?') }}
                    </a> </p>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
