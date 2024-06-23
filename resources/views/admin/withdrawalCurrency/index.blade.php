<x-sidebar>
    <div class="container mx-auto text-sm">
        <div class="bg-white border w-full  mt-4 lg:w-2/3 rounded-xl sm:my-6 sm:p-6">
            <div class="flex items-center  justify-between p-4">
<div>
    <h1 class="text-base lg:text-2xl font-bold ">Withdrawal Currencies </h1>
    <p class="text-gray-500 text-xs mb-4">Here you add the available withdrwal currencies </p>

</div>
                <div class="flex justify-end items-center ">
                   
                    <a href="{{route('admin.setting.withdrawalcurrencies.create')}}" class="bg-blue-500 text-white py-2 px-4 rounded text-sm">Create </a>
                </div>
            </div>
            <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-200 text-gray-600  text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">#</th>
                        <th class="py-3 px-6 text-left">Name</th>
                     
                        <th class="py-3 px-6 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @php
                        $i = 1;
                    @endphp
                    @foreach($withdrawalCurrencies as $walletCurrency)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            {{$i++}}
                        </td>
                        <td class="py-3 px-6 text-left whitespace-nowrap">{{$walletCurrency->name}}</td>
                       
                        <td class="py-3 px-6 text-left flex items-center gap-2">
                            <a href="{{route('admin.setting.withdrawalcurrencies.show',$walletCurrency->id)}}" class="bg-blue-500 text-white py-1 px-2 rounded text-xs">Edit</a>
                            <form action="{{ route('admin.setting.withdrawalcurrencies.destroy', $walletCurrency->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white py-1 px-2 rounded text-xs">Delete</button>
                            </form>
                    </tr>
               @endforeach
                </tbody>
                
                
            </table>
            </div>
            <div class="mt-4 bg-white">
                {{ $withdrawalCurrencies->links() }}
            </div>
        </div>
    </div>
</x-sidebar>
{{-- @if (session('success'))
    <script>
       showAlert( {{ session('success') }},"success")
    </script>
@endif
@if (session('error'))
    <script>
       showAlert( "{{ session('error') }}", "danger")
    </script>
@endif --}}