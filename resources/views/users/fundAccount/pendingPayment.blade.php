<x-sidebar>
    <style>
        .custom-line-2 {
            --curved-lineHeight: 5;
            /* default: element height */
            --curved-lineWidth: 1;
            /* default: 3 */
            --curved-lineColor: #1877f2;
            /* default: 'black' */
            --curved-lineSpread: 10;
            /* default: 50 */
            height: 5px;
        }

        /* line style */
        hr {
            height: 20px;
            border: 0;
            background: paint(curved-line);
            color: #f8f9fa !important;
        }
    </style>

    <div class="lg:px-10  py-4">
        <h2 class="text-2xl text-gray-700 font-bold border-b">Deposit funds into your account</h2>





        <div class="">
            {{-- waiting head  --}}
            <div class="flex items-center justify-between bg-blue-500 text-white text-sm px-4 py-2  mt-5">
                <div class="flex items-center gap-3">
                    <img src="https://media.tenor.com/On7kvXhzml4AAAAj/loading-gif.gif" alt="" width="22"
                        height="22">
                    <p class="font-bold">Awaiting Payment </p>
                </div>
                <div>
                    <p id="timer" class="text-sm">5:00</p>
                </div>
            </div>

            {{-- content  --}}
            <div class="bg-gray-50 py-5">
                <div class="flex flex-col gap-y-4 md:w-2/3 mx-auto ">

                    <div class="flex items-center justify-between gap-3 mt-4">
                        <div>
                            <p>Pay with</p>
                        </div>
                        <div>
                            @php
                                $cryptoName = '';
                                $cryptoName = $cryptoWallet->wallet_name;
                            @endphp
                            <p>${{ $cryptoWallet->wallet_name }}</p>


                        </div>

                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p>Amount</p>
                        </div>
                        <div>
                            <p>${{ number_format($amount) }}</p>
                        </div>

                    </div>

                </div>
            </div>

            {{-- divider line  --}}
            <hr class="custom-line-2 mb-5">
            <div class="text-center w-full py-3">
                <p>To complete your payment, please send <span id="equivalentAmount" class="font-bold"></span> to the
                    address below.</p>
            </div>

            <hr class="custom-line-2 mt-5">


            {{-- bottom section  --}}
            <div class="bg-gray-50 pt-5 text-gray-700">
                <div class="flex items-center justify-center py-10  flex-col">
                    <p class="text-sm uppercase">Amount</p>
                    <p class="font-bold text-2xl"><span id="equivalentAmount1"></span></p>

                    <p class="text-sm mt-4">NETWORK</p>
                    <p class="font-semibold text-lg">{{ $cryptoName }}</p>
                    <p class="text-sm mt-4">ADDRESS</p>
                    <p
                        class="font-semibold  py-4 rounded-lg px-4  bg-gradient-to-b mt-5 from-gray-200 flex items-center gap-4 to-white shadow-sm  border ">
                        {{ $cryptoWallet->wallet_address }} <span
                            class="col hover:bg-gray-300 group-hover:bg-gray-800 duration-400 p-2 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4 cursor-pointer "
                                data-tippy-content="Copy referral link" id="copyIcon">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" />
                            </svg>


                        </span></p>
                        <script>
                            document.getElementById('copyIcon').addEventListener('click', function() {
                                var copyText = " {{ $cryptoWallet->wallet_address }} ";
                                navigator.clipboard.writeText(copyText).then(function() {
                                    alert('Copied to clipboard');
                                }).catch(function() {
                                    alert('Failed to copy text');
                                });
                            });
                        </script>
                </div>
                <p
                    class="text-sm text-red-500 pb-2 pt-5 w-full text-center font-bold flex items-center justify-center gap-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4 font-bold">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m4.5 5.25 7.5 7.5 7.5-7.5m-15 6 7.5 7.5 7.5-7.5" />
                    </svg> Send payment proof below <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 font-bold">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m4.5 5.25 7.5 7.5 7.5-7.5m-15 6 7.5 7.5 7.5-7.5" />
                    </svg>
                </p>
            </div>

            <hr class="custom-line-2 ">
            {{-- payment proof form --}}
            <div class="flex items-center justify-content-center py-5 w-full">

                <form id="hiddenImageUploadForm" action="{{ route('fundAccount.store') }}"
                    class="mx-auto w-full flex-col flex justify-center" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="amount" value="{{ $amount }}">
                    <input type="hidden" name="wallet_id" value="{{ $cryptoWallet->id }}">
                    <input type="file" id="hiddenImageUploadInput" class="hidden" name="payment_proof"
                        accept="image/jpeg,image/png,image/jpg">

                    <div id="paymentProofButton"
                        class=" flex items-center justify-center cursor-pointer min-h-48  hover:bg-gray-100 w-full border-dashed border-gray-300 border-2 py-4 px-5  rounded-xl bg-gray-50 flex-col text-gray-600 text-sm">
                        <!-- SVG and text here -->
                        Click here to add payment proof
                    </div>

                    <div class="mt-4">
                        <button type="submit"
                            class="bg-blue-500 text-white rounded-lg px-4 py-2 text-sm w-full md:w-max ml-auto">Submit
                            Payment
                            Proof
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</x-sidebar>


<script>
    (async function() {
        if (CSS["paintWorklet"] === undefined)
            await import(
                "https://unpkg.com/css-paint-polyfill@next/dist/css-paint-polyfill.js"
            );
        CSS.paintWorklet.addModule(
            "https://unpkg.com/curved-line@1.0.0/curved-line.js"
        );
    })();
</script>
<script>
    window.onload = function() {

        document.getElementById('paymentProofButton').addEventListener('click', function() {
            document.getElementById('hiddenImageUploadInput').click();
        });

        const walletName = "{{ $cryptoName }}";

        if (walletName === 'Bitcoin') {
            usdToBitcoin({{ $amount }});
        } else if (walletName === 'Ethereum') {
            usdToEthereum({{ $amount }});
        }


        var fiveMinutes = 60 * 5,
            display = document.getElementById('timer');
        startTimer(fiveMinutes, display);

        function startTimer() {
            var timer = 300,
                minutes, seconds;
            setInterval(function() {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    timer = 0;
                }
            }, 1000);
        }




        async function usdToEthereum(usdAmount) {
            const ethereumApi = "https://api.coingecko.com/api/v3/simple/price?ids=ethereum&vs_currencies=usd";

            try {
                const response = await fetch(ethereumApi);
                const ethereumData = await response.json();

                if (ethereumData.ethereum && ethereumData.ethereum.usd) {
                    const ethereumPrice = ethereumData.ethereum.usd;
                    const ethereumAmount = usdAmount / ethereumPrice;

                    // Assign the value to a text element
                    document.getElementById('equivalentAmount').innerText = ethereumAmount + " ETH";
                    document.getElementById('equivalentAmount1').innerText = ethereumAmount + " ETH";
                } else {
                    throw new Error("Error fetching data from API. (Check your Network)");
                }
            } catch (error) {
                document.getElementById('equivalentAmount').innerText = error.message;
            }




        }


        async function usdToBitcoin(usdAmount) {
            const bitcoinApi = "https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd";

            try {
                const response = await fetch(bitcoinApi);
                const bitcoinData = await response.json();

                if (bitcoinData.bitcoin && bitcoinData.bitcoin.usd) {
                    const bitcoinPrice = bitcoinData.bitcoin.usd;
                    const bitcoinAmount = usdAmount / bitcoinPrice;

                    // Assign the value to a text element
                    document.getElementById('equivalentAmount').innerText = bitcoinAmount + " BTC";
                    document.getElementById('equivalentAmount1').innerText = bitcoinAmount + " BTC";
                } else {
                    throw new Error("Error fetching data from API. (Check your Network)");
                }
            } catch (error) {
                document.getElementById('equivalentAmount').innerText = error.message;
            }
        }


    };
</script>
