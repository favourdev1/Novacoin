<x-sidebar>
    <div class="container mx-auto text-sm">
        <div class="bg-white border rounded-xl sm:my-6 sm:p-6">
            <div class="flex items-center mb-4 justify-between">

                <h1 class="text-2xl font-bold ">All testimonials </h1>
                <a href="{{ route('admin.setting.testimonial.create') }}"
                    class="bg-blue-500 text-white py-3 px-4 rounded-xl text-xs">Create testimonial</a>

            </div>

           
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-200 text-gray-600  text-sm leading-normal">
                        <tr>
                            <th class="py-3 px-6 text-left">#</th>
                   
                            <th class="py-3 px-6 text-left">Name</th>
                            <th class="py-3 px-6 text-left">Testimonial</th>

                           
                            <th class="py-3 px-6 text-left">Date</th>
                            <th class="py-3 px-6 text-left">Action</th>

                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($testimonials as $testimonial)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    {{ $i++ }}
                                </td>


                                <td class="py-3 px-6 text-left whitespace-nowrap flex items-center gap-4">
                                    <img
                                            class="w-10 h-10 rounded-full border"
                                            src="{{ $testimonial->image }}" />{{ $testimonial->name }}</td>
                        

                                <td class="py-3 px-6 text-left">
                                   {{ $testimonial->message}}
                                </td>

                            
                                <td class="py-3 px-6 text-left">{{ $testimonial->created_at }}</td>

                                <td class="py-3 px-6 text-left flex items-center gap-2">

                                    @if ($testimonial->status == 'approved' || $testimonial->status == 'disapproved')
                                        <button type="submit" disabled
                                            class="bg-gray-500 text-white py-1 px-2 rounded text-xs cursor-not-allowed">{{ $testimonial->status }}</button>
                                    @else
                                       
                                            <a href="{{ route('admin.setting.testimonial.show', $testimonial->id) }}" class="bg-green-500 text-white py-1 px-2 rounded text-xs">Edit</a>
                                    
                                        <form action="{{ route('admin.setting.testimonial.destroy', $testimonial->id) }}" method="POST">
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
                {{ $testimonials->links() }}
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
