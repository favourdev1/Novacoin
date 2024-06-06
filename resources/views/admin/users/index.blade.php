<x-sidebar>
    <div class="container mx-auto text-sm">
        <div class="bg-white border rounded-xl sm:my-6 sm:p-6">
            <div class="flex items-center mb-4 justify-between">

                <h1 class="text-2xl font-bold ">All users </h1>

            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-200 text-gray-600  text-sm leading-normal">
                        <tr>
                            <th class="py-3 px-6 text-left">#</th>
                            <th class="py-3 px-6 text-left">Username</th>
                            <th class="py-3 px-6 text-left">Firstname</th>

                            <th class="py-3 px-6 text-left">Lastname</th>
                            <th class="py-3 px-6 text-left">Email</th>

                            <th class="py-3 px-6 text-left">Role</th>
                            <th class="py-3 px-6 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @php
                        $i = 1;
                        @endphp
                        @foreach($AllUsers as $users)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                {{$i++}}
                            </td>
                            <td class="py-3 px-6 text-left whitespace-nowrap">{{$users->username}}</td>
                            <td class="py-3 px-6 text-left">{{$users->firstname}}</td>

                            <td class="py-3 px-6 text-left">{{$users->lastname}}</td>
                            <td class="py-3 px-6 text-left">{{$users->email}}</td>
                            <td class="py-3 px-6 text-left">
                            <span class="{{ $users->role == 'users' ? 'bg-green-200 text-green-600' : 'bg-red-200 text-red-600' }} py-1 px-3 rounded-full text-xs">
                                {{ $users->role }}
                            </span>
                        </td>
                            <td class="py-3 px-6 text-left flex items-center gap-2">
                                <a
                                    href=""
                                    class="bg-blue-500 text-white py-1 px-2 rounded text-xs"
                                >Edit</a>
                                <form
                                    action=" }}"
                                    method="POST"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="bg-red-500 text-white py-1 px-2 rounded text-xs"
                                    >Delete</button>
                                </form>
                        </tr>
                        @endforeach
                    </tbody>


                </table>
            </div>
            <div class="mt-4 bg-white">
                {{ $AllUsers->links() }}
            </div>
        </div>
    </div>
</x-sidebar>
{{-- @if (session('success'))
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
@endif --}}