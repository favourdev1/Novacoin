<x-sidebar>
    <div class="lg:px-10 py-4">
        <div class="pb-4">


            <div class="flex items-center justify-between text-gray-700">

                <h3 class="font-semibold text-2xl pb-4">{{ $greetings }}</h3>
                <div class="flex items-center gap-4 text-white ">
                    <a href="{{ route('investment.index') }}"
                        class="bg-blue-500  rounded-lg px-4 text-sm focus:ring-0 focus:outline-none py-1.5">
                        Invest </a>
                    <a href="{{ route('fundAccount.index') }}"
                        class="bg-indigo-500 rounded-lg px-4 text-sm focus:ring-0 focus:outline-none py-1.5">
                        Fund  </a>
                </div>
            </div>

            <div class="flex flex-no-wrap overflow-x-auto md:grid md:grid-cols-4 gap-2  removescrollbarHeight h-max">


                <div class="rounded-xl border  p-4 bg-white h-100 mh-6 min-w-[80vw] md:min-w-0">
                    <h5 class="text-gray-600 text-sm"> Today's Earnings <a tabindex="0" class="h6 mb-0" role="button"
                            data-bs-toggle="popover" data-bs-trigger="focus" data-bs-placement="top"
                            data-bs-original-title="" title="">
                            <i class="bi bi-info-circle-fill small"></i>
                        </a></h5>
                    <h2 class="fw-bold text-dark" style="font-size:2rem" id="todayEarnings">
                        ${{ $calcInvestmentEarningsToday == 0 ? 0 : number_format($calcInvestmentEarningsToday, 5) }}
                    </h2>

                </div>
                <x-dashboard-card  :width="'min-w-[80vw] md:min-w-0'" title="Investment Earnings" info="After US royalty withholding tax"
                amount="${{ number_format($earnings, 2) }}" />
                <x-dashboard-card   :width="'min-w-[80vw] md:min-w-0'" title="Active Investments" info="After US royalty withholding tax"
                amount="{{ $myActiveInvestmentCount }}" />

                <x-dashboard-balance-card title="Balance" info="" amount="${{ Auth::user()->balance }}" />

            </div>

        </div>`



        {{-- section  --}}

        <div class="flex lg flex-col lg:flex-row items-start gap-4">
            {{-- active Iinvestments  --}}
            <div class="w-full border rounded-xl flex-1 h-full ">
                <div class="p-4 border-b">
                    <h3 class="font-semibold ">Active Investments</h3>
                </div>
                <div class="p-4 min-h-96 w-full">
                    <div class="flex justify-between items-center w-full h-full">
                        <div class="flex items-center w-full h-full ">
                            {{-- no active inestment --}}
                            <div class="rounded-xl border py-2 px-4 bg-gray-100 w-max mx-auto text-center text-sm">
                                No active investment

                            </div>
                        </div>
                    </div>
                </div>
            </div>





            {{-- side section --}}
            <div class="border rounded-xl w-full lg:w-3/12 p-3 flex justify-center flex-col gap-2">
                <p class="font-bold text-lg">Refer and earn</p>
                <p class="text-sm text-gray-500">Use the link below to invite your friends </p>
                <div class="border rounded-xl px-4 py-2  flex items-center gap-3 bg-gray-50 text-sm">
                    <p class=" whitespace-nowrap flex-1 overflow-hidden text-gray-700" id="referralUrl">
                        @php
                            $appUrl = url('/register');
                            $token = Auth::user()->referral_code;
                            $url = $appUrl . '?ref=' . $token;
                        @endphp

                        {{ $url }}
                    </p>
                    {{-- copy icon --}}
                    <div class="col hover:bg-gray-300 group-hover:bg-gray-800 duration-400 p-2 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4 cursor-pointer "
                            data-tippy-content="Copy referral link" id="copyIcon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" />
                        </svg>

                    </div>
                </div>

                <p class="font-bold text-lg border-t mt-3 pt-4">My Referrals </p>
                <div class=" text-sm max-h-64 min-h-48 overflow-y-scroll hide-scrollbar">
                    <div class="">
                        @foreach ($referrals as $referral)
                            <div class="flex items-center  bg-gray-50 border rounded-xl py-2 px-4 mt-2">
                                {{-- profile image  --}}
                                {{-- <img src="{{ asset('images/profile.jpg') }}" alt="profile" class="w-10 h-10 rounded-full"> --}}
                                <div>
                                    <p class="font-semibold text-sm">{{ $referral->firstname . ' ' . $referral->lastname }}
                                    </p>
                                    <p class="text-gray-500 text-xs">Joined {{ $referral->created_at->diffForHumans() }}
                                    </p>
                                </div>

                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>


</x-sidebar>
<script>
    document.getElementById('copyIcon').addEventListener('click', function() {
        var copyText = document.getElementById("referralUrl").innerText;
        navigator.clipboard.writeText(copyText).then(function() {
            alert('Copied to clipboard');
        }).catch(function() {
            alert('Failed to copy text');
        });
    });
</script>

<style>
    .hide-scrollbar {
        scrollbar-width: none;
        /* For Firefox */
        -ms-overflow-style: none;
        /* For Internet Explorer and Edge */
    }

    .hide-scrollbar::-webkit-scrollbar {
        width: 0px;
        /* For Chrome, Safari, and Opera */
    }
</style>


<script>
    // axios requet to fetch todays earnings
    setInterval(() => {
        getTodayEarnings()
    }, 1000);

    function getTodayEarnings() {
        const todayEarnings = document.querySelector('#todayEarnings');
        const endpoint = "{{ route('todayEarnings.Api', ['id' => Auth::user()->id]) }}";
        axios.get(endpoint)
            .then(response => {
                // console.log(response.data)
                if (response.data.earnings) {
                    if (response.data.earnings > 0) {
                        todayEarnings.textContent = "$" + Number(response.data.earnings).toFixed(5);
                    } else {
                        todayEarnings.textContent = "$0";
                    }
                } else {
                    todayEarnings.textContent = "$0";
                }
            })
            .catch(error => {
                todayEarnings.textContent = "$0";
                console.error(error);
            });
    }
</script>