<x-sidebar>
    <div class="container mx-auto text-sm">
        <div class="bg-white border rounded-xl sm:my-6 sm:p-6 p-2 mt-2">
            <div class="flex items-center mb-4 justify-between">

                <h1 class="text-2xl font-bold ">All Faqs </h1>
                <a href="{{ route('admin.setting.faq.create') }}"
                    class="bg-blue-500 text-white py-3 px-4 rounded-xl text-xs">Create faq</a>

            </div>

           
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-200 text-gray-600  text-sm leading-normal">
                        <tr>
                            <th class="py-3 px-6 text-left">#</th>
                            {{-- <th class="py-3 px-6 text-left">category</th> --}}
                            <th class="py-3 px-6 text-left">Question</th>
                            <th class="py-3 px-6 text-left">Answer</th>
                           
                            <th class="py-3 px-6 text-left">Date</th>
                            <th class="py-3 px-6 text-left">Action</th>

                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($faqs as $faq)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    {{ $i++ }}
                                </td>
                                {{-- <td class="py-3 px-6 text-left whitespace-nowrap">{{ $faq->category }}</td> --}}
                        

                                <td class="py-3 px-6 text-left whitespace-nowrap max-w-48 overflow-x-hidden">
                                   {{ $faq->question}}
                                </td>

                                <td class="py-3 px-6 text-left whitespace-nowrap max-w-48 overflow-x-hidden">
                                    {{ $faq->answer}}
                                 </td>
                                <td class="py-3 px-6 text-left whitespace-nowrap max-w-48 overflow-x-hidden">{{ $faq->created_at }}</td>

                                <td class="py-3 px-6 text-left whitespace-nowrap max-w-48 overflow-x-hidden flex items-center gap-2">

                                    @if ($faq->status == 'approved' || $faq->status == 'disapproved')
                                        <button type="submit" disabled
                                            class="bg-gray-500 text-white py-1 px-2 rounded text-xs cursor-not-allowed">{{ $faq->status }}</button>
                                    @else
                                       
                                            <a href="{{ route('admin.setting.faq.show', $faq->id) }}" class="bg-green-500 text-white py-1 px-2 rounded text-xs">Edit</a>
                                    
                                        <form action="{{ route('admin.setting.faq.destroy', $faq->id) }}" method="POST">
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
                {{ $faqs->links() }}
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
