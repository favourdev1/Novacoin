<x-sidebar>
    <div class="lg:px-10 py-4 flex items-center justify-center">

        @php
            $headerText = 'Withdraw Funds';
        @endphp

        <div class="rounded-lg border border-[#eoeoeo] w-full md:w-3/5 xl:w-2/4  2xl:w-1/3 text-gray-600 pb-5">
            <form class="w-full  h-full" id="withdrawForm" action="{{ route('withdraw.fund') }}"
                method="POST">
                @csrf
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

                <div class="grid grid-cols-2 p-4 ">
                    <x-dashboard-balance-card title="balance" amount="{{ Auth::user()->balance }}" info="" />
                </div>
                <div class="p-4  px-6">
                    <p class="font-extrabold  uppercase text-blue-700 text-sm">Amount to Withdraw </p>

                    <div class="text-xs rounded-xl">
                        <label for="withdrawalAmount" class="block text-gray-700 text-sm font-bold mb-2">Enter
                            withdrawal
                            amount:</label>
                        <input type="number" id="withdrawalAmount" name="withdrawalAmount"
                            class="appearance-none text-sm border border-gray-300 w-full rounded  py-1.5  px-3 text-gray-700 focus:outline-none focus:ring-2"
                            min="0" step="0.01" placeholder="0.00">
                    </div>

                    <div class="text-xs rounded-xl mt-4">
                        <label for="walletAddress" class="block text-gray-700 text-sm font-bold mb-2">Wallet
                            Address</label>
                        <input type="text" id="walletAddress" name="walletAddress"
                            class="appearance-none text-sm border border-gray-300 w-full rounded  py-1.5  px-3 text-gray-700 focus:outline-none focus:ring-2"
                            placeholder="Enter wallet address">
                    </div>
                    <div class="mt-4">
                        <label for="wallet_id" class="text-gray-600 text-sm">Choose Cryptocurrency for
                            Withdrawal</label>
                        <select name="wallet_id" id="wallet_id"
                            class="text-sm border border-gray-300 rounded-lg w-full p-2 mt-1">
                            <option disabled selected>Select a cryptocurrency</option>
                            @foreach ($WalletCurrencies as $wallet)
                                <option value="{{ $wallet->id }}">{{ $wallet->name }}</option>
                            @endforeach
                        </select>
                        @error('wallet_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                </div>


            </form>
            <div x-data="{ showModal: false }" @confirm-investment.window="invest" class=" flex items-center p-4">
                <button type="submit" id="submitButton" @click="showModal = true" disabled
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 mt-2  px-4 rounded-full focus:outline-none focus:ring w-full disabled:bg-gray-300 text-sm">
                    Withdraw Funds
                </button>

                <!-- Modal Component -->
                <x-investdialog id="investDialog" title="Confirm Withdrawal" description=""
                    image="{{ asset('assets/images/investImage.png') }}" buttonText="Confirm" />

            </div>
        </div>


        <script>
            function invest() {
                console.log('testing')
                const withdrawForm = document.getElementById('withdrawForm');
                withdrawForm.submit();

            }

            document.getElementById('withdrawalAmount').addEventListener('input', calcWithdrawal);

            function calcWithdrawal() {
                const submitButton = document.getElementById('submitButton')
                const withdrawalAmount = document.getElementById('withdrawalAmount').value;
                const withdrawalAmountNum = Number(withdrawalAmount)
                console.log(withdrawalAmountNum)
                if (withdrawalAmountNum > 0) {
                    submitButton.removeAttribute('disabled')
                    // submitButton.classList.remove('')
                } else {
                    submitButton.setAttribute('disabled', true);

                }


                var investDialog = document.getElementById('descriptionModal');
                investDialog.innerHTML = 'You are about to withdraw <strong>' + withdrawalAmount +
                    '</strong> in this plan. \n By Clicking Continue, you agree with our terms and conditions of operation including that of our withdrawal policy';
            }
        </script>
    </div>
</x-sidebar>
