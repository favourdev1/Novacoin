<div x-data="{ isActive: {{ $isActive ? 'true' : 'false' }} }" :class="{'hover:ring-blue-600': isActive, 'hover:ring-gray-500': !isActive}" class="rounded-3xl duration-300 hover:ring-2 border shadow-sm py-5 px-3 prose card-hover">



    <!-- Card body START -->
    <div class="con-items ">
        <div class="item item1 ">
            <div class="con-img">
                <img src="1-3.png" alt="">
            </div>
            <header>
                <div class="text-center">
                    <span
                        class="text-sm px-4 py-2 rounded-full font-semibold {{ $investmentStatus == 'active' ? 'bg-blue-100 text-blue-700' : 'bg-red-100 text-red-500' }} rounded">
                        {{ ucfirst($investmentStatus) }}
                    </span>
                </div>
                <h2 class="text-center my-0  text-blue-800 py-3">{{ $investmentName }}</h2>

            </header>
            <div class=" flex flex-col justify-evenly">
            <ul class="px-0 mx-auto">
                <li class=" flex items-center gap-4">
                    <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </span>
                    Min Investment Value: ${{ number_format($minInvestment) }}
                </li>
                <li class=" flex items-center gap-4">
                    <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </span>
                    Max Investment Value: ${{ number_format($maxInvestment) }}
                </li>

                <li class=" flex items-center gap-4">
                    <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </span>
                    Daily Interest: {{ $dailyInterest }}%
                </li>
                <li class=" flex items-center gap-4">
                    <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </span>
                    Investment Duration: {{ $investmentDuration }}Days
                </li>

            </ul>
        </div>
        @if($isActive)
            <button onclick="window.location.href='{{ route('investment.show', $investmentId) }}'"
                class="w-full text-center rounded-full py-3 font-bold bg-blue-100 hover:bg-blue-600 duration-500 text-blue-600 hover:text-blue-100 cursor-pointer">
                Choose Plan
            </button>
            @else
            <button class="px-4 py-2 bg-gray-500 text-white w-full text-center rounded-full py-3 font-bold cursor-not-allowed" disabled>Ended</button>
            @endif 
        </div>

    </div>


@if($isActive)
    <style>
        .card-hover:hover button {
            transition: all 0.5s;
            background-color: rgb(37 99 235 / var(--tw-bg-opacity));
            color: rgb(219 234 254 / var(--tw-text-opacity));

        }
    </style>
@else
    <style>
        .card-hover:hover button {
            transition: all 0.5s;
            background-color: rgb(107 114 128 / var(--tw-bg-opacity));
            color: rgb(219 234 254 / var(--tw-text-opacity));
        }
    </style>

    @endif
</div>
