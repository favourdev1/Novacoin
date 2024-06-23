@extends('layouts.home')

@section('title', 'Novacoin Holdings')
@section('content')
     {{-- hero seciton  --}}
     <div class="flex">

        <div class="container mx-auto overflow-hidden">
            {{-- <div class="ripple-shape absolute overflow-hidden">
                <span class="ripple-1"></span>
                <span class="ripple-2"></span>
                <span class="ripple-3"></span>
                <span class="ripple-4"></span>
            </div> --}}
            <div
                class=" flex flex-col  py-5 md:flex-row-reverse items-center min-h-[80vh] pb-20  justify-between  px-4 overflow-hidden">


                <div class="flex-1 flex relative overflow-hidden ">


                    <img src="{{ asset('assets/images/illustration.png') }}" data-aos="fade-up" alt="hero image"
                        class="flex-1" />




                </div>
                <div
                    class=" w-full md:w-2/4 flex flex-col gap-3 text-center lg:text-left items-center md:items-start">
                    <div class="relative rounded-full px-3 py-1 text-sm leading-6 text-gray-600 ring-1 ring-gray-600/20 w-max hover:ring-gray-600/60 cursor-pointer"
                        data-aos="fade-up" data-aos-delay="300">
                        Trade with Assurance
                    </div>
                    <h2 class="font-bold text-3xl lg:text-6xl bg-clip-text text-transparent bg-gradient-to-r from-gray-200 via-gray-50 to-gray-500"
                        data-aos="fade-up" data-aos-delay="600">
                        Invest for Future in Stable Platform and Make Fast Money
                    </h2>

                    <h6 class="text-slate-300 text-base md:text-xl " data-aos="fade-up" data-aos-delay="900">Take
                        advantage of our financial instruments and renowed tech to the Next Level.</h6>
                    <a href="{{ Auth::check() ? route('dashboard.index') : route('login') }}"
                        class="bg-blue-600 rounded-full py-3.5 px-6 w-max gap-4 flex items-center focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Get Started Now
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


<div class="block lg:flex  lg:overflow-hidden" data-aos="fade-up">
    <div class="w-full lg:w-7/12  py-20 flex items-center relative  h-full  bg-[#111111]  px-10">
        <div class="w-full text-center lg:text-left lg:w-3/4 lg:ml-auto h-full lg:pr-20">
            <h2 class="text-white text-3xl lg:text-5xl font-bold  ">We’ve made it easier for anyone to get started.
            </h2>
            <p class="font-light lg:text-base text-gray-400">Finally, you can access pre-vetted low-medium risk
                primary and secondary
                investment
                opportunities easily with any amount you have. No hidden fees/charges. Thorough due diligence and
                pre-vetting on all investments are carried out for maximum safety.</p>
        </div>
    </div>
    <div class="w-full lg:w-5/12 "
        style="background-image: url('https://storage.googleapis.com/piggyvestwebsite/piggywebsite2020/image_10ee373879/image_10ee373879.png'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
    </div>
</div>


{{-- how it works  --}}
<div class="container mx-auto px-5 py-10 flex flex-col items-center">
    <h2 class="font-black text-2xl lg:text-5xl text-center py-5 ">How it works</h2>
    <div
        class="grid lg:grid-cols-3 xl:grid-cols-3 justify-center items-center md:grid-cols-3 sm:grid-cols-2  grid-cols-1 gap-4 text-xl  w-full lg:w-2/3">
        <div class="flex flex-col items-center gap-4">
            <img src="{{ asset('assets/images/createAcc.png') }}" class="w-20 h-20" alt="step 1">
            <h3 class="font-bold text-xl">Create an Account</h3>
            <p class="text-gray-500 text-sm text-center">Sign up for a free account and start investing in minutes
            </p>
        </div>
        <div class="flex flex-col items-center gap-4">
            <img src="{{ asset('assets/images/browseOpp.png') }}" class="w-20 h-20" alt="step 2">
            <h3 class="font-bold text-xl">Invest in Opportunities</h3>
            <p class="text-gray-500 text-sm text-center">Browse through our investment opportunities and invest in
                the one that suits you
            </p>
        </div>
        <div class="flex flex-col items-center gap-4">
            <img src="{{ asset('assets/images/invest.png') }}" class="w-24 h-20" alt="step 3">
            <h3 class="font-bold text-xl">Earn Daily Interest</h3>
            <p class="text-gray-500 text-sm text-center">Earn daily interest on your investment and get your
                capital back at the end of the
                investment period</p>
        </div>
    </div>
</div>



{{-- recent opportunities to invest  --}}
<div class="py-10  flex items-center flex-col justify-center px-5">
    <h2 class="font-black text-center  text-2xl lg:text-5xl py-5 " id="plans">Recent Opportunities to invest in </h2>

    <div
        class="grid lg:grid-cols-3 xl:grid-cols-3 md:grid-cols-3 sm:grid-cols-2  grid-cols-1 gap-4 text-xl  w-full lg:w-2/3">

        @foreach ($investmentPlan as $investment)
            @if ($investment->status == 'active')
                <x-investment-card investment-id="{{ $investment->id }}"
                    investment-name="{{ $investment->name }}" investment-amount="{{ $investment->min_amount }}"
                    investment-status="{{ $investment->status }}" min-investment="{{ $investment->min_amount }}"
                    max-investment="{{ $investment->max_amount }}"
                    investment-duration="{{ $investment->duration }}"
                    daily-interest="{{ $investment->daily_interest }}"
                    is-active="{{ $investment->status == 'inactive' }}" />
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

            <img src="{{ asset('assets\images\faq.png') }}" class="hidden md:block mt-5 max-h-80"
                alt="Faq icon">


        </div>
        <div class="lg:w-1/2" id="faq">

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
{{-- <div class="bg-gray-900">
    <img alt="Turbopack" loading="lazy" width="614" height="614" decoding="async" data-nimg="1"
        class=" dark:block" src="{{ asset('assets/images/hexagon.svg') }}" style="color: transparent;">
</div> --}}

{{-- testmimonial --}}
<div class="flex flex-col justify-center  w-full mx-auto p overflow-hidden pb-6 relative">
    <h3 class="font-bold text-2xl lg:text-4xl mx-auto">What Other Investors Say About Us</h3>
    {{-- comments  --}}
    <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
        aria-hidden="true">
        <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
            style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
        </div>
    </div>


    <div class=" pt-10 p-4 gap-10 flex items-center marquee-content ">
        @foreach ($testimonials as $testimonial)
            <x-testimonial-component review="{{ $testimonial->message }}" avatar="{{ $testimonial->image }}"
                name="{{ $testimonial->name }}" />
        @endforeach

    </div>
</div>
@endsection