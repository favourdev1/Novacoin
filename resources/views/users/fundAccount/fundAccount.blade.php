<x-sidebar>
    <div class="lg:px-10 lg:max-w-[50vw] py-4">

        <h2 class="text-2xl text-gray-700 font-bold">Deposit funds into your account</h2>

        <form action="{{route('fundAccount.processPayment')}}" method="POST">
            @csrf
            <div class="mt-4">
                <label for="amount" class="text-gray-600 text-sm">Amount</label>
                <input type="number" name="amount" id="amount"
                    class="border border-gray-300 rounded-lg w-full p-2 mt-1 text-sm"/>
                    @error('amount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mt-4">
                <label for="wallet_id" class="text-gray-600 text-sm">Payment Method</label>
                <select name="wallet_id" id="wallet_id"
                    class="text-sm border border-gray-300 rounded-lg w-full p-2 mt-1">
                    <option disabled selected>Select a wallet </option>
                    @foreach ($Wallets as $wallet)
                        <option value="{{ $wallet->id }}">{{ $wallet->wallet_name }}</option>
                    @endforeach
                </select>
                @error('wallet_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>

            <div class="mt-4">
                <button type="submit" class="bg-blue-500 text-white rounded-lg px-4 py-2 text-sm">Deposit</button>
            </div>
            <div class="border-t my-3"></div>

        </form>
        <div class="">
            <div class="rounded-xl border px-3 py-4">


                <crypto-converter-widget class="card rounded-xl" live symbol fiat="united-states-dollar" crypto="bitcoin"
                font-family="Figtree, ui-sans-serif, system-ui, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'"
                font-size="14px" font-weight="400" font-color="#000" font- amount="1" border-radius="0.60rem"
                background-color="#fff" decimal-places="6"><a href="https://cr.today/" rel="noopener">Converter
                    Widget</a></crypto-converter-widget>
            <script src="https://cdn.jsdelivr.net/gh/dejurin/crypto-converter-widget/dist/latest.min.js" ></script>

            </div>



            <div class="text-sm text-gray-700 prose rounded-xl border bg-gray-50 mt-5 border-dashed py-4 px-3">
                <h4 class="text-red-600 font-bold text-lg">Important Guide</h4>
                <p>This is a simple guide on how to use the currency today rate converter.</p>
                <ul>
                    <li>To Change Fiat/Crypto: Simply tap on the provided option and customize it with your
                        preferred
                        currency.</li>
                    <li>To change values: Tap on the displayed figures and edit them to your desired amount for
                        conversion.</li>
                </ul>
            </div>
        </div>
    </div>


  


</x-sidebar>
