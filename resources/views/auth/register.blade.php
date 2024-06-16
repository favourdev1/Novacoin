<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <img src="{{ asset('assets/images/logo (2).png') }}" alt="logo" class="w-16 h-16 mx-auto" class="">
             
         </x-slot>
         <div class="w-full flex items-center justify-center font-bold text-xl mt-2 text-[#404059]">
 
            Create a new account
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mt-2">
                <x-label for="username" value="{{ __('Username') }}" />
                <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')"
                    required autofocus autocomplete="username" />
            </div>

            <div class="mt-2">
                <x-label for="firstname" value="{{ __('Firstname') }}" />
                <x-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')"
                    required autofocus autocomplete="firstname" />
            </div>


            <div class="mt-4">
                <x-label for="lastname" value="{{ __('Lastname') }}" />
                <x-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')"
                    required autofocus autocomplete="lastname" />
            </div>
            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
            </div>


            <div class="mt-4">

                @php
    $referralId = request('ref');
@endphp
                <x-label for="referral_id" value="{{ __('Referral Id') }}" />
                <x-input id="referral_id" class="block mt-1 w-full" type="text" value="{{ $referralId }}"
                    name="referral_id"  />
            </div>
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">' .
                                        __('Privacy Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif
            <div class="mt-2  text-sm flex  items-center gap-2 justify-end">

                Already have an account ? <a
                    class="underline text-sm font-semibold hover:font-bold text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-0"
                    href="{{ route('login') }}">
                    {{ __('Login ') }}
                </a>
            </div>
            <div class="flex items-center justify-end mt-4">

                <x-button class=" flex-1 text-center">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>

        <div class="flex items-center justify-center gap-3 py-4 text-center">
            <p class="text-sm text-gray-400">
                By continuing, you agree to our <a
                    class="underline text-sm text-gray-500 hover:text-blue-900 hover:font-bold rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    href="{{ route('terms') }}">
                    {{ __('Terms and Conditions') }}
                </a>
                and <a
                    class="underline text-sm text-gray-500 hover:text-blue-900 hover:font-bold rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    href="{{ route('privacyPolicy') }}">
                    {{ __('Privacy Policy') }}
                </a>
            </p>
        </div>
    </x-authentication-card>
</x-guest-layout>
