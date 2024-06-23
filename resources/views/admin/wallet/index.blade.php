<x-sidebar>
    <div class="container mx-auto text-sm">
        <div class="bg-white border rounded-xl sm:my-6 sm:p-6 mt-4">
            <div class="flex items-center mb-4 justify-between p-4">

                <h1 class="text-2xl font-bold ">All Wallets </h1>
                <a href="{{ route('admin.setting.wallet.create') }}"
                    class="bg-blue-500 text-white py-3 px-4 rounded-xl text-xs">Create Wallet</a>

            </div>

           
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-200 text-gray-600  text-sm leading-normal">
                        <tr>
                            <th class="py-3 px-6 text-left">#</th>
                            <th class="py-3 px-6 text-left">Wallet Name</th>
                            <th class="py-3 px-6 text-left">Wallet Address</th>

                           
                            <th class="py-3 px-6 text-left whitespace-nowrap">Date</th>
                            <th class="py-3 px-6 text-left">Action</th>

                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($wallets as $wallet)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    {{ $i++ }}
                                </td>
                                <td class="py-3 px-6 text-left whitespace-nowrap">{{ $wallet->wallet_name }}</td>
                        

                                <td class="py-3 px-6 text-left">
                                   {{ $wallet->wallet_address}}
                                </td>

                            
                                <td class="py-3 px-6 text-left whitespace-nowrap">{{ $wallet->created_at }}</td>

                                <td class="py-3 px-6 text-left flex items-center gap-2">

                                    @if ($wallet->status == 'approved' || $wallet->status == 'disapproved')
                                        <button type="submit" disabled
                                            class="bg-gray-500 text-white py-1 px-2 rounded text-xs cursor-not-allowed">{{ $wallet->status }}</button>
                                    @else
                                       
                                            <a href="{{ route('admin.setting.wallet.show', $wallet->id) }}" class="bg-green-500 text-white py-1 px-2 rounded text-xs">Edit</a>
                                    
                                        <form action="{{ route('admin.setting.wallet.destroy', $wallet->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white py-1 px-2 rounded text-xs focus:outline-none">Delete</button>
                                        </form>
                                    @endif
                            </tr>
                        @endforeach
                    </tbody>


                </table>
            </div>
            <div class="mt-4 bg-white">
                {{ $wallets->links() }}
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
