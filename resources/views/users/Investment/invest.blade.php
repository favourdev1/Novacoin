<x-sidebar>

    <div class="flex items-center justify-center pt-20">
        @php
          
            $formAction = route('investmentPlan.store');
            $formMethod =  'POST';
            $buttonText = 'Create Investment Plan';
            $headerText = 'Confirm and Invest';
        @endphp


        <div class="rounded-lg border border-[#eoeoeo] w-full md:w-2/4 xl:w-1/3  text-gray-600">
            <div class="py-4 border-b flex items-center">
                <a href="{{ url()->previous() }}"
                    class=" text-white font-bold py-2 pl-4 cursor-pointer rounded-full focus:outline-none focus:ring-0 mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 text-gray-800">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m18.75 4.5-7.5 7.5 7.5 7.5m-6-15L5.25 12l7.5 7.5" />
                    </svg>

                </a>
                <h3 class="font-bold text-xl ">{{ $headerText }}</h3>
            </div>


            <div class="grid grid-cols-2 p-4">
                <x-dashboard-balance-card title="balance" amount="{{ Auth::user()->balance }}" info="" />
            </div>

            <x-validation-errors class="mb-4 px-10" />

            <div class="p-4">
                <div class="mb-4 flex items-center justify-between w-full">
                    <label for="name" class="block text-sm text-gray-700  font-bold mb-2">Investment Name</label>
                    <input disabled type="text" name="name" id="name"
                        class="appearance-none text-sm border-none rounded w-max py-1.5  px-3 text-gray-700 focus:outline-none focus:ring"
                        value="{{ $investmentPlan->name  }}" required>
                </div>

                <div class="mb-4 flex items-center justify-between w-full">
                    <label for="min_amount" class="block text-sm text-gray-700  font-bold mb-2">Min Investment
                        Amount</label>
                    <input disabled type="number" name="min_amount" id="min_amount"
                        class="appearance-none text-sm border-none rounded w-max py-1.5  px-3 text-gray-700 focus:outline-none focus:ring"
                        value="{{ $investmentPlan->min_amount  }}" required>
                </div>

                <div class="mb-4 flex items-center justify-between w-full">
                    <label for="max_amount" class="block text-sm text-gray-700  font-bold mb-2">Max Investment
                        Amount</label>
                    <input disabled type="number" name="max_amount" id="max_amount"
                        class="appearance-none text-sm border-none rounded w-max py-1.5  px-3 text-gray-700 focus:outline-none focus:ring"
                        value="{{ $investmentPlan->max_amount}}" required>
                </div>

                <div class="mb-4 flex items-center justify-between w-full">
                    <label for="duration" class="block text-sm text-gray-700  font-bold mb-2">Duration (days)</label>
                    <input disabled type="number" name="duration" id="duration"
                        class="appearance-none text-sm border-none rounded w-max py-1.5  px-3 text-gray-700 focus:outline-none focus:ring"
                        value="{{ $investmentPlan->duration  }}" required>
                </div>

                <div class="mb-4 flex items-center justify-between w-full">
                    <label for="daily_interest" class="block text-sm text-gray-700  font-bold mb-2">Daily Interest
                    </label>
                    <input disabled type="" name="daily_interest" id="daily_interest"
                        class="appearance-none text-sm border-none rounded w-max py-1.5 bg-transparent  px-3 text-gray-700 focus:outline-none focus:ring"
                        value="{{ $investmentPlan->daily_interest . '% Every day' }}" required>
                </div>

            </div>
            <form class="" action="{{ $formAction }}" method="POST">
                @csrf
<input type="hidden" name ="investment_plan_id" value="{{ $investmentPlan->id }}">
                <div class="p-4">
                    <p class="font-extrabold  uppercase text-blue-700 text-sm">Amount to Invest </p>
                    <input type="number" name="investment_amount" id="investment_amount"
                        class="appearance-none text-sm border border-gray-300 w-full rounded  py-1.5  px-3 text-gray-700 focus:outline-none focus:ring-2"
                        placeholder="{{ $investmentPlan->min_amount }}" value="{{ $investmentPlan->min_amount }}"
                        required>

                    <div class="border text-xs bg-gray-100 rounded-xl mt-5 py-3 px-2">
                        <p>You would earn <span id="calcEarnings" class="font-bold text-base"> $0.00 </span> every day</p>
                    </div>
                </div>

                <div class="p-4 border-t flex items-center">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2  px-4 rounded-full focus:outline-none focus:ring w-full text-sm">
                        {{ $buttonText }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-sidebar>
<script>
    let intervalId = null;
    let counterIntervalId = null;
    const updateInterval = 20; // Adjust this value to change the update frequency

    // call the calculate first so the animation can play 
    calcEarnings();

    // add event listener 
    document.getElementById('investment_amount').addEventListener('input', calcEarnings);

    function calcEarnings() {
        const investmentAmount = document.getElementById('investment_amount').value;

        if (investmentAmount == '' || investmentAmount == 0) {
            document.getElementById('calcEarnings').innerText = `$0.00`;
            clearInterval(intervalId);
            clearInterval(counterIntervalId);
            return;
        }

        const dailyInterest = {{ $investmentPlan->daily_interest }};
        const earnings = investmentAmount * dailyInterest / 100;
        let count = 0;
        const increment = earnings / 100; // Adjust this value to change the speed of the counter

        clearInterval(intervalId);
        clearInterval(counterIntervalId);

        intervalId = setInterval(() => {
            count += increment;
            if (count >= earnings) {
                count = earnings;
                clearInterval(intervalId);
                clearInterval(counterIntervalId);
            }
            document.getElementById('calcEarnings').innerText = `$${count.toFixed(2)}`;
        }, updateInterval); // Adjust this value to change the update frequency

        counterIntervalId = setInterval(() => {
            if (updateInterval > 200) {
                updateInterval -= 20;
            }
        }, 50);
    }
</script>
