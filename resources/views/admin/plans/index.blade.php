<x-sidebar>
    <div class="container mx-auto text-sm">
        <div class="bg-white border rounded-xl sm:my-6 sm:p-6 p-2 mt-2">
            <div class="flex items-center mb-4 justify-between">

                <h1 class="text-2xl font-bold ">All Plans </h1>
                <div class="flex justify-end items-center ">
                   
                    <a href="{{route('investmentPlan.create')}}" class="bg-blue-500 text-white py-2 px-4 rounded text-sm">Create Investment</a>
                </div>
            </div>
            <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-200 text-gray-600  text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">#</th>
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Min Amount</th>
       
                        <th class="py-3 px-6 text-left">Max Amount</th>
                        <th class="py-3 px-6 text-left">Daily Interest</th>
                        <th class="py-3 px-6 text-left">Duration</th>
                        <th class="py-3 px-6 text-left">Status</th>
                        <th class="py-3 px-6 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @php
                        $i = 1;
                    @endphp
                    @foreach($investmentPlan as $plan)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            {{$i++}}
                        </td>
                        <td class="py-3 px-6 text-left whitespace-nowrap">{{$plan->name}}</td>
                        <td class="py-3 px-6 text-left">{{$plan->min_amount}}</td>
         
                        <td class="py-3 px-6 text-left">{{$plan->max_amount}}</td>
                        <td class="py-3 px-6 text-left">{{$plan->daily_interest}}</td>
                        <td class="py-3 px-6 text-left">{{$plan->duration}}</td>
                        <td class="py-3 px-6 text-left">
                            <span class="{{ $plan->status == 'active' ? 'bg-green-200 text-green-600' : 'bg-red-200 text-red-600' }} py-1 px-3 rounded-full text-xs">
                                {{ $plan->status }}
                            </span>
                        </td>
                        <td class="py-3 px-6 text-left flex items-center gap-2">
                            <a href="{{route('investmentPlan.show',$plan->id)}}" class="bg-blue-500 text-white py-1 px-2 rounded text-xs">Edit</a>
                            <form action="{{ route('investmentPlan.destroy', $plan->id) }}" method="POST">
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
                {{ $investmentPlan->links() }}
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