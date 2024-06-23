<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="{{ asset('assets/aos/dist/aos.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('assets/aos/dist/aos.js') }}"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    @livewireStyles

</head>

<body class="font-sans antialiased text-base text-gray-900 flex flex-col scroll-smooth">
    <div class="bg-[#111111] text-white pb-4">
        {{-- navbar --}}
        <header class="bg-transparent">
            <nav class="mx-auto flex container items-center justify-between p-6 lg:px-8" aria-label="Global">
                <div class="flex lg:flex-1">
                    <a href="{{ route('home') }}" class="-m-1.5 p-1.5">
                        <div class="flex items-center font-black">
                            <x-authentication-card-logo :width="'50'" />
                            {{ config('app.name') }}
                        </div>
                    </a>
                </div>
                <div class="flex lg:hidden">
                    <button type="button" id="navShowBtn"
                        class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>
                <div class="hidden lg:flex lg:gap-x-12">

                    <a href="#" class="text-sm font-semibold leading-6 text-gray-200">Home</a>
                    <a href="#features" class="text-sm font-semibold leading-6 text-gray-200">Features</a>
                    <a href="#" class="text-sm font-semibold leading-6 text-gray-200">About</a>
                    <a href="#plans" class="text-sm font-semibold leading-6 text-gray-200">Our Plans</a>

                    <a href="#faq" class="text-sm font-semibold leading-6 text-gray-200">Faq</a>
                </div>
                <div class="hidden lg:flex lg:flex-1 items-center gap-4 lg:justify-end">
                    @auth
                        <a href="{{ route('dashboard.index') }}">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold leading-6 text-gray-200">Log in <span
                                aria-hidden="true">&rarr;</span></a>
                        {{-- create a frreee account button  --}}
                        <a href="{{ route('register') }}">
                            <button class="bg-slate-50 text-black text-sm rounded-full px-4 py-2">
                                Create Free Account
                            </button>
                        </a>

                    @endauth

                </div>
            </nav>
            <!-- Mobile menu, show/hide based on menu open state. -->
            <div class="hidden lg:hidden" id="mobileMenu" role="dialog" aria-modal="true">
                <!-- Background backdrop, show/hide based on slide-over state. -->
                <div class="fixed inset-0 z-10"></div>
                <div
                    class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                    <div class="flex items-center justify-between">
                        <a href="{{ route('home') }}" class="-m-1.5 p-1.5">
                            <div class="flex items-center font-black text-gray-900 gap-4 text-base uppercase">
                                <div class="bg-[#111111] rounded-full w-[50px]">

                                    <x-authentication-card-logo :width="'50'" />
                                </div>
                                {{ config('app.name') }}
                            </div>
                        </a>
                        <button type="button" id="navCloseButton" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                            <span class="sr-only">Close menu</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="mt-6 flow-root duration-500">
                        <div class="-my-6 divide-y divide-gray-500/10">
                            <div class="space-y-2 py-6">
                                <div class="-mx-3">

                                    <!-- 'Product' sub-menu, show/hide based on menu state. -->

                                
                                </div>
                                <a href="#"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Home</a>
                                <a href="#features"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Features</a>
                                <a href="#plans"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Investment Plans</a>
                                    <a href="#"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">About</a>
                                <a href="#faq"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Faq</a>
                            </div>
                            <div class="py-6">
                                <a href="{{route('login')}}"
                                    class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Log
                                    in</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const navShowBtn = document.getElementById('navShowBtn')
                const closeButton = document.getElementById('navCloseButton');
                const mobileMenu = document.getElementById('mobileMenu');

                navShowBtn.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden')
                })
                closeButton.addEventListener('click', function() {
                    // Toggle the mobile menu visibility
                    mobileMenu.classList.toggle('hidden');
                });
            });
        </script>


        <script>
            document.getElementById('menuButton').addEventListener('click', function() {
                document.querySelector('ul').classList.toggle('hidden');
                document.querySelector('div.hidden').classList.toggle('flex');
                document.querySelector('div.hidden').classList.toggle('hidden');
            });
        </script>
        <script src="https://widgets.coingecko.com/coingecko-coin-price-marquee-widget.js"></script>
        <coingecko-coin-price-marquee-widget coin-ids="bitcoin,ethereum,eos,ripple,litecoin" currency="usd"
            background-color="#ffffff" locale="en"></coingecko-coin-price-marquee-widget>
   @yield('content')
    {{-- footer  --}}
    <x-footer-component />







    <x-chat-widget-component />



    @livewireScripts

    <script>
        AOS.init({
            duration: 400, // values from 0 to 3000, with step 50ms
            easing: 'ease', // default easing for AOS animations
            once: false, // whether animation should happen only once - while scrolling down
            mirror: false,
        });
    </script>
</body>

</html>

