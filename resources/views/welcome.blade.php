<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    <script src="{{asset('assets/aos/dist/aos.js')}}" ></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    @livewireStyles

</head>

<body class="font-sans antialiased text-base text-gray-900 flex flex-col">
    <div class="bg-[#111111] text-white pb-4">
        {{-- navbar --}}
        <nav class="flex justify-items-center  text-gray-100 ">
            <div class="container flex items-center px-5  border-b border-[#eeeeee34] mx-auto py-5 ">
                {{-- icon --}}
                <div class="flex items-center font-black">
                    <x-authentication-card-logo :width="'50'" />
                    {{ env('APP_NAME') }}
                </div>
                {{-- links --}}
                <ul class="flex items-center gap-8  justify-center flex-1 ">
                    {{-- <li class="cursor-pointer hover:underline">Product</li>
                    <li class="cursor-pointer hover:underline">About</li>
                    <li class="cursor-pointer hover:underline">Contact</li> --}}
                </ul>

                <div class="flex items-center gap-3 px-3 ">
                    @auth
                        <a href="{{ route('dashboard.index') }}">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}">
                            <button class="border-r-2 border-gray-100 pr-4">
                                Login
                            </button>
                        </a>
                        {{-- create a frreee account button  --}}
                        <a href="{{ route('register') }}">
                            <button class="bg-slate-50 text-black text-sm rounded-full px-4 py-2">
                                Create Free Account
                            </button>
                        </a>

                    @endauth
                </div>
            </div>
        </nav>

        <script src="https://widgets.coingecko.com/coingecko-coin-price-marquee-widget.js"></script>
        <coingecko-coin-price-marquee-widget coin-ids="bitcoin,ethereum,eos,ripple,litecoin" currency="usd"
            background-color="#ffffff" locale="en"></coingecko-coin-price-marquee-widget>
        {{-- hero seciton  --}}
        <div class="flex">

            <div class="container mx-auto">

                <div
                    class=" flex flex-col  py-5 md:flex-row-reverse items-center min-h-[80vh] pb-20  justify-between  px-4">


                    <div class="w-[80%] flex relative " >
                        <img src="{{ asset('assets/images/illustration.png') }}" data-aos="fade-up"
                        data-aos-duration="3000"  alt="hero image" class="flex-1" />

                        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
                            aria-hidden="true">
                            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-3 text-center lg:text-left items-center md:items-start">
                        <div
                            class="relative rounded-full px-3 py-1 text-sm leading-6 text-gray-600 ring-1 ring-gray-600/60 w-max hover:ring-gray-900/20">
                            Announcing our next round of funding. <a href="#"
                                class="font-semibold text-indigo-600"><span class="absolute inset-0"
                                    aria-hidden="true"></span>Read more <span aria-hidden="true">&rarr;</span></a>
                        </div>
                        <h2
                            class="font-bold text-3xl lg:text-6xl bg-clip-text text-transparent bg-gradient-to-r from-gray-200 via-gray-50 to-gray-500">
                            Fastest & secure platform to invest in crypto
                        </h2>

                        <h6 class="text-slate-300 text-sm md:text-xl">Buy and sell cryptocurrencies, trusted by 10M
                            wallets with over $30 billion in transactions.</h6>
                        <a href="{{ Auth::check() ? route('dashboard.index') : route('login') }}"
                            class="bg-blue-600 rounded-full py-3.5 px-6 w-max gap-4 flex items-center focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Start Investing
                            <div class="rounded-full p-2 bg-white inline-flex ">
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-900 w-4 h-4 font-extrabold"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                </svg>


                            </div>
                        </a>
                    </div>



                </div>
            </div>

        </div>

    </div>



    <div class="bg-white">

        <div class="relative isolate px-6 pt-14 lg:px-8">
            <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
                aria-hidden="true">
                <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>
        </div>
        <div class="mx-auto max-w-2xl F ">
            <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
                aria-hidden="true">
                <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>
        </div>
        <div class="text-center">
            <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Data to enrich your online business
            </h1>
            <p class="mt-6 text-lg leading-8 text-gray-600">Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure
                qui lorem cupidatat commodo. Elit sunt amet fugiat veniam occaecat fugiat aliqua.</p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <a href="#"
                    class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Get
                    started</a>
                <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Learn more <span
                        aria-hidden="true">→</span></a>
            </div>
        </div>
    </div>
    <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
        aria-hidden="true">
        <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
            style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
        </div>
    </div>
    </div>
    </div>



    <style>
        .gradients_glowConic__yzj22 {
            background: conic-gradient(from 180deg at 50% 50%, #2a8af6 0deg, #a853ba 180deg, #472ae9 1turn);
        }

        .gradients_glow__chSIP {
            mix-blend-mode: normal;
            filter: blur(75px);
            will-change: filter;
        }
    </style>



    {{-- scection  --}}


    {{-- features  --}}

    <x-features-section />


    <div class="block lg:flex  lg:overflow-hidden">
        <div class="w-full lg:w-7/12  py-20 flex items-center relative  h-full  bg-[#111111]  px-10">
            <div class="w-full text-center lg:text-left lg:w-3/4 lg:ml-auto h-full lg:pr-20">
                <h2 class="text-white text-3xl lg:text-5xl font-bold  ">We’ve made it easier for anyone to get started.</h2>
                <p class="font-light lg:text-base text-gray-400">Finally, you can access pre-vetted low-medium risk primary and secondary
                    investment
                    opportunities easily with any amount you have. No hidden fees/charges. Thorough due diligence and
                    pre-vetting on all investments are carried out for maximum safety.</p>
            </div>
        </div>
        <div class="w-full lg:w-5/12 "
            style="background-image: url('https://storage.googleapis.com/piggyvestwebsite/piggywebsite2020/image_10ee373879/image_10ee373879.png'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
        </div>
    </div>



    {{-- recent opportunities to invest  --}}
    <div class="py-10  flex items-center flex-col justify-center px-5">
        <h2 class="font-black text-center  text-2xl lg:text-5xl py-5 ">Recent Opportunities to invest in </h2>

        <div
            class="grid lg:grid-cols-3 xl:grid-cols-3 md:grid-cols-3 sm:grid-cols-2  grid-cols-1 gap-4 text-xl  w-full lg:w-2/3">

            @foreach ($investmentPlan as $investment)
            @if($investment->status == 'active')
                <x-investment-card investment-id="{{ $investment->id }}" investment-name="{{ $investment->name }}"
                    investment-amount="{{ $investment->min_amount }}" investment-status="{{ $investment->status }}"
                    min-investment="{{ $investment->min_amount }}" max-investment="{{ $investment->max_amount }}"
                    investment-duration="{{ $investment->duration }}"
                    daily-interest="{{ $investment->daily_interest }}" 
                    is-active="{{ $investment->status == 'inactive'}}" 
                    />
            @endif
            @endforeach
        </div>
    </div>



    {{-- testimonial --}}

    <div class="container mx-auto px-5">
        <div class="flex flex-col md:flex-row  py-10 gap-8 justify-around">
            <div class="lg:w-1/3 ">
                <h1 class="font-bold text-base text-blue-700">Frequently asked questions</h1>
                <p class="text-4xl font-black text-gray-800"> Everything you need to know</p>




            </div>
            <div class="lg:w-1/2">

                <section>
                    <h3 class="text-sm font-semibold leading-7 text-slate-400">Compatibility</h3>
                    <dl class="mt-2 divide-y divide-slate-100">

                        @foreach ($faqs as $faq)
                            <details class="group py-4 marker:content-['']">
                                <summary
                                    class="flex w-full cursor-pointer select-none justify-between text-left text-base font-semibold leading-7 text-slate-900 group-open:text-indigo-600 [&amp;::-webkit-details-marker]:hidden">
                                    {{ $faq->question }}<svg
                                        class="ml-4 mt-0.5 h-6 w-6 flex-none stroke-slate-700 group-open:stroke-indigo-500"
                                        fill="none" xmlns="http://www.w3.org/2000/svg" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M18 12H6"></path>
                                        <path class="group-open:hidden" d="M12 6v12"></path>
                                    </svg></summary>
                                <div class="pb-6 pt-6">
                                    <div
                                        class="prose prose-slate max-w-none prose-a:font-semibold prose-a:text-indigo-600 hover:prose-a:text-indigo-500">

                                        <p>{{ $faq->answer }}</p>
                                    </div>
                                </div>
                            </details>
                        @endforeach

                    </dl>
                </section>
            </div>
        </div>
    </div>
    <div class="bg-gray-900
    <img alt="Turbopack" loading="lazy" width="614" height="614" decoding="async"
        data-nimg="1" class=" dark:block" src="{{ asset('assets/images/hexagon.svg') }}"
        style="color: transparent;">
    </div>
    {{-- footer  --}}
    <x-footer-component />







    <x-chat-widget-component />



    @livewireScripts

    <script>
        AOS.init();
        <script>
</body>

</html>
