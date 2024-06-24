<x-sidebar>
    <div class="container mx-auto text-sm">
        <div class="bg-white border rounded-xl sm:my-6 sm:p-6 p-2 mt-2">
            <div class="flex items-center mb-4 justify-between">

                <h1 class="text-2xl font-bold ">All funding </h1>

            </div>

            <div class="flex items-center gap-3 pb-4">
                <a href="{{ route('admin.fundings', ['filter' => 'pending']) }}"
                    class="rounded-lg px-4 py-2 text-sm {{ request()->query('filter') == 'pending' ? 'bg-blue-100 text-blue-500' : 'bg-gray-100 text-gray-500' }}">Pending</a>

                <a href="{{ route('admin.fundings', ['filter' => 'approved']) }}"
                    class="rounded-lg px-4 py-2 text-sm {{ request()->query('filter') == 'approved' ? 'bg-blue-100 text-blue-500' : 'bg-gray-100 text-gray-500' }}">Approved</a>

                <a href="{{ route('admin.fundings', ['filter' => 'disapproved']) }}"
                    class="rounded-lg px-4 py-2 text-sm {{ request()->query('filter') == 'disapproved' ? 'bg-blue-100 text-blue-500' : 'bg-gray-100 text-gray-500' }}">Disapproved</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-200 text-gray-600  text-sm leading-normal">
                        <tr>
                            <th class="py-3 px-6 text-left">#</th>
                            <th class="py-3 px-6 text-left">Username</th>
                            <th class="py-3 px-6 text-left">Crypto currency</th>

                            <th class="py-3 px-6 text-left">Amount</th>
                            <th class="py-3 px-6 text-left">Payment Proof</th>

                            <th class="py-3 px-6 text-left">Status</th>
                            {{-- <th class="py-3 px-6 text-left">Approval Status</th> --}}
                            <th class="py-3 px-6 text-left">Date</th>
                            <th class="py-3 px-6 text-left">Action</th>

                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($AllFundings as $funding)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    {{ $i++ }}
                                </td>
                                <td class="py-3 px-6 text-left whitespace-nowrap">{{ $funding->username }}</td>
                                <td class="py-3 px-6 text-left">{{ $funding->wallet_name }}</td>

                                <td class="py-3 px-6 text-left">${{ $funding->amount }}</td>
                                <td class="py-3 px-6 text-left"><a
                                        href="{{ asset('storage/payment_proofs/' . $funding->payment_proof) }}"><img
                                            class="w-5 h-5"
                                            src="{{ asset('storage/payment_proofs/' . $funding->payment_proof) }}" /></a>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <span
                                        class="{{ $funding->status == 'approved' ? 'bg-green-200 text-green-600' : 'bg-gray-200 text-grey-600' }} py-1 px-3 rounded-full text-xs">
                                        {{ $funding->status }}
                                    </span>
                                </td>

                                {{-- <td class="py-3 px-6 text-left">
                                    {{ $funding->approved_by == null ? 'not appproved' : 'approved' }}</td> --}}
                                <td class="py-3 px-6 text-left">{{ $funding->created_at }}</td>

                                <td class="py-3 px-6 text-left flex items-center gap-2">

                                    @if ($funding->status == 'approved' || $funding->status == 'disapproved')
                                        <button type="submit" disabled
                                            class="bg-gray-500 text-white py-1 px-2 rounded text-xs cursor-not-allowed">{{ $funding->status }}</button>
                                    @else
                                        <form action="{{ route('admin.approvePayment') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id"
                                                value="{{ $funding->fund_accountId }}">
                                            @method('POST')
                                            <button type="submit"
                                                class="bg-green-500 text-white py-1 px-2 rounded text-xs">Approve
                                                Payment</button>
                                        </form>

                                        <form action="{{ route('admin.disapprovePayment') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id"
                                                value="{{ $funding->fund_accountId }}">
                                            @method('POST')
                                            <button type="submit"
                                                class="bg-red-500 text-white py-1 px-2 rounded text-xs focus-within:borer:none">Disapprove
                                                Payment</button>
                                        </form>
                                    @endif
                            </tr>
                        @endforeach
                    </tbody>


                </table>
            </div>
            <div class="mt-4 bg-white">
                {{ $AllFundings->links() }}
            </div>
        </div>
    </div>
</x-sidebar>
@if (session('success'))
    <script>
        showAlert({
            {
                session('success')
            }
        }, "success")
    </script>
@endif
@if (session('error'))
    <script>
        showAlert("{{ session('error') }}", "danger")
    </script>
@endif
