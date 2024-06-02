<x-sidebar>
    <div class="lg:px-10 py-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-2">

            <x-dashboard-card title="Today's Earnings" info="After US royalty withholding tax" amount="0" />
            <x-dashboard-card title="Investment Earnings " info="After US royalty withholding tax" amount="0" />
            

            <x-dashboard-balance-card title="Balance" info="" amount="${{ Auth::user()->balance }}" />

        </div>

        <div class="py-4 pl-2">
            <p class="font-bold text-blue-700 uppercase text-xl ">Investment Plans </p>
        </div>

        <div class="flex items-center gap-3 pb-4">
            <a href="{{ route('investment.index', ['filter' => 'pending']) }}"
                class="rounded-lg px-4 py-2 text-sm {{ request()->query('filter') == 'pending' ? 'bg-blue-100 text-blue-500' : 'bg-gray-100 text-gray-500' }}">My Investments</a>

            <a href="{{ route('investment.index', ['filter' => 'active']) }}"
                class="rounded-lg px-4 py-2 text-sm {{ request()->query('filter') == 'approved' ? 'bg-blue-100 text-blue-500' : 'bg-gray-100 text-gray-500' }}">Active</a>

            <a href="{{ route('investment.index', ['filter' => 'inactive']) }}"
                class="rounded-lg px-4 py-2 text-sm {{ request()->query('filter') == 'ended' ? 'bg-blue-100 text-blue-500' : 'bg-gray-100 text-gray-500' }}">Ended</a>
        </div>
        <div>
            <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2  grid-cols-1 gap-4">
                @foreach ($investmentPlan as $investment)
                    <x-investment-card
                    investment-id="{{$investment->id}}" investment-name="{{ $investment->name }}"
                        investment-amount="{{ $investment->min_amount }}" investment-status="{{ $investment->status }}"
                        min-investment="{{ $investment->min_amount }}" max-investment="{{ $investment->max_amount }}"
                        investment-duration="{{ $investment->duration }}"
                        daily-interest="{{ $investment->daily_interest }}" />
                @endforeach
            </div>
        </div>
    </div>
</x-sidebar>
