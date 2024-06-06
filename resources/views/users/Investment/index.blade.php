<x-sidebar>
    <div class=" py-4 bg-[#F6F8FA]">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-2 lg:px-10">


            <div class="">
                <div class="rounded-xl border  p-4 bg-white h-100">
                    <h5 class="text-gray-600 text-sm"> Today's Earnings <a tabindex="0" class="h6 mb-0" role="button"
                            data-bs-toggle="popover" data-bs-trigger="focus" data-bs-placement="top"
                            data-bs-original-title="" title="">
                            <i class="bi bi-info-circle-fill small"></i>
                        </a></h5>
                    <h2 class="fw-bold text-dark" style="font-size:2rem" id="todayEarnings">
                        ${{ number_format($calcInvestmentEarningsToday, 5) }}</h2>

                </div>
            </div>
            <x-dashboard-card title="Investment Earnings" info="After US royalty withholding tax"
                amount="{{ number_format($earnings, 2) }}" />
            <x-dashboard-card title="Active Investments" info="After US royalty withholding tax"
                amount="{{ $myActiveInvestmentCount }}" />


            <x-dashboard-balance-card title="Balance" info="" amount="${{ Auth::user()->balance }}" />

        </div>



        <div x-data="{ tab: 'tab1' }" class="w-full mb-6 md:mb-0">
            <div class="w-full overflow-hidden text-sm pt-4">
                <div class="lg:px-10">
                    <nav class="flex flex-col sm:flex-row gap-3 border-b">
                        <button @click="tab = 'tab1'"
                            :class="{ 'text-blue-500 border-b-2 font-medium border-blue-500': tab === 'tab1' }">
                            <span
                                class="text-gray-600 py-1.5  mb-1.5 px-2 block hover:text-gray-500 focus:outline-none hover:bg-gray-200/90 rounded-lg">
                                My Investments
                                {{-- <span class="bg-gray-300/50 rounded-full font-bold py-1 px-3"> {{$myActiveInvestmentCount}}
                            </span> --}}
                            </span>
                        </button>
                        <button @click="tab = 'tab2'"
                            :class="{ 'text-blue-500 border-b-2 font-medium border-blue-500': tab === 'tab2' }"><span
                                class="text-gray-600 py-1.5  mb-1.5 px-2 block hover:text-gray-500 focus:outline-none hover:bg-gray-200/90 rounded-lg">
                                Active Investments
                                <span class="bg-gray-300/50 rounded-full font-bold py-1 px-3">
                                    {{ $availbleInvestmentCount }}
                                </span>
                        </button>
                        <button @click="tab = 'tab3'"
                            :class="{ 'text-blue-500 border-b-2 font-medium border-blue-500': tab === 'tab3' }"><span
                                class="text-gray-600 py-1.5  mb-1.5 px-2 block hover:text-gray-500 focus:outline-none hover:bg-gray-200/90 rounded-lg">
                                Ended Investment
                                {{-- <span class="bg-gray-300/50 rounded-full font-bold py-1 px-3"> {{$allEndedInvestmentCount}}
                            </span> --}}
                        </button>
                    </nav>
                </div>
                <div id="tab-content" class="p-5 lg:px-10 bg-white min-h-[80vh]">
                    <!-- Content for Tab 1 -->
                    <div x-show="tab === 'tab1'" class="tab-content active">
                        {{-- <div class="flex items-center gap-3 pb-4 bg-white ">
                            <a href="{{ route('investment.index', ['filter' => 'pending']) }}"
                                class="rounded-lg px-4 py-2 text-sm {{ request()->query('filter') == 'pending' ? 'bg-blue-100 text-blue-500' : 'bg-gray-100 text-gray-500' }}">My Investments</a>
                
                            <a href="{{ route('investment.index', ['filter' => 'active']) }}"
                                class="rounded-lg px-4 py-2 text-sm {{ request()->query('filter') == 'approved' ? 'bg-blue-100 text-blue-500' : 'bg-gray-100 text-gray-500' }}">Active</a>
                
                            <a href="{{ route('investment.index', ['filter' => 'inactive']) }}"
                                class="rounded-lg px-4 py-2 text-sm {{ request()->query('filter') == 'ended' ? 'bg-blue-100 text-blue-500' : 'bg-gray-100 text-gray-500' }}">Ended</a>
                        </div> --}}

                        <div class="py-4 pl-2">
                            <p class="font-bold text-gray-700 uppercase text-xl ">My Investment</p>
                        </div>
                        <div>
                            <div
                                class="grid lg:grid-cols-3 xl:grid-cols-4 md:grid-cols-3 sm:grid-cols-2  grid-cols-1 gap-4">
                                @foreach ($allMyActiveInvestment as $investment)
                                    <x-investment-card investment-id="{{ $investment->id }}"
                                        investment-name="{{ $investment->name }}"
                                        investment-amount="{{ $investment->min_amount }}"
                                        investment-status="{{ $investment->status }}"
                                        min-investment="{{ $investment->min_amount }}"
                                        max-investment="{{ $investment->max_amount }}"
                                        investment-duration="{{ $investment->duration }}"
                                        daily-interest="{{ $investment->daily_interest }}" />
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- Content for Tab 2 -->
                    <div x-show="tab === 'tab2'" class="tab-content">
                        <div class="py-4 pl-2">
                            <p class="font-bold text-blue-700 uppercase text-xl ">Available Investment </p>
                        </div>
                        <div>
                            <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2  grid-cols-1 gap-4">
                                @foreach ($investmentPlan as $investment)
                                    <x-investment-card investment-id="{{ $investment->id }}"
                                        investment-name="{{ $investment->name }}"
                                        investment-amount="{{ $investment->min_amount }}"
                                        investment-status="{{ $investment->status }}"
                                        min-investment="{{ $investment->min_amount }}"
                                        max-investment="{{ $investment->max_amount }}"
                                        investment-duration="{{ $investment->duration }}"
                                        daily-interest="{{ $investment->daily_interest }}" />
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- Content for Tab 3 -->
                    <div x-show="tab === 'tab3'" class="tab-content">
                        <p>Content for Tab 3</p>
                    </div>
                </div>
            </div>
        </div>

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
                        console.log(response.data)
                        if (response.data.earnings) {
                            todayEarnings.textContent = Number(response.data.earnings).toFixed(5);
                        } else {
                            todayEarnings.textContent = 0;
                        }
                    })
                    .catch(error => {
                        todayEarnings.textContent = 0;
                        console.error(error);
                    });
            }
        </script>

</x-sidebar>
