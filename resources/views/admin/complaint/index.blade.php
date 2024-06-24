<x-sidebar>
    <div class="container mx-auto text-sm">
        <div class="bg-white border rounded-xl sm:my-6 p-2 sm:p-6 min-h-[80vh] mt-4">
            <div class="flex items-center mb-4 justify-between p-2">

                <h1 class="text-2xl font-bold ">Contacts Us</h1>

            </div>

         
            <div class="overflow-x-auto h-full">
                <table class="min-w-full  bg-white h-full">
                    <thead class="bg-gray-200 text-gray-600  text-sm leading-normal">
                        <tr>
                            <th class="py-3 px-6 text-left text-nowrap">#</th>
                            <th class="py-3 px-6 text-left text-nowrap">Name</th>
                            <th class="py-3 px-6 text-left text-nowrap">Email</th>

                            <th class="py-3 px-6 text-left text-nowrap max-w-72">Subject</th>


                            <th class="py-3 px-6 text-left text-nowrap">Status</th>

                            <th class="py-3 px-6 text-left text-nowrap">Date</th>
                            <th class="py-3 px-6 text-left text-nowrap">Action</th>

                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light h-full">
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($complaints as $complaint)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    {{ $i++ }}
                                </td>
                                <td class="py-3 px-6 text-left whitespace-nowrap">{{ $complaint->name }}</td>
                                <td class="py-3 px-6 text-left text-nowrap max-w-72  flex items-center gap-4 ">
                                    <span id="email">
                                        {{ $complaint->email }}
                                    </span> 
                                    <button onclick="copyToClipboard('email')"><svg
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                                        </svg>
                                    </button>
                                </td>

                                <td class="py-3 px-6 text-left text-nowrap">{{ $complaint->subject }}</td>

                           
                                <script>
                                    function copyToClipboard(elementId) {
                                        var copyText = document.getElementById(elementId);
                                        var textArea = document.createElement("textarea");
                                        textArea.value = copyText.textContent;
                                        document.body.appendChild(textArea);
                                        textArea.select();
                                        document.execCommand("Copy");
                                        textArea.remove();

                                        showAlert("Copied to clipboard", "success", 3)
                                    }
                                </script>
                                <td class="py-3 px-6 text-left">
                                    <span
                                        class="{{ $complaint->status == 'approved' ? 'bg-green-200 text-green-600' : 'bg-gray-200 text-grey-600' }} py-1 px-3 rounded-full text-xs text-nowrap">
                                        {{ $complaint->status }}
                                    </span>
                                </td>


                                <td class="py-3 px-6 text-left text-nowrap">{{ $complaint->created_at }}</td>

                                <td class="py-3 px-6 text-left flex items-center gap-2">

                                    @if ($complaint->status == 'approved' || $complaint->status == 'disapproved')
                                        <button type="submit" disabled
                                            class="bg-gray-500 text-white py-1 px-2 rounded text-xs cursor-not-allowed">{{ $complaint->status }}</button>
                                    @else
                                        {{-- <x-dropdown align="right" width="48">
                                            <x-slot name="trigger">
                                                <span class="inline-flex rounded-md">
                                                    <button type="button"
                                                        class="inline-flex items-center px-3 py-2 border border-[#eeeeee] text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">


                                                        <svg class=" -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="currentColor">

                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                                        </svg>

                                                    </button>
                                                </span>
                                            </x-slot>

                                            <x-slot name="content">
                                                <!-- Other dropdown links -->


                                              



                                            </x-slot>
                                        </x-dropdown> --}}

                                        <x-dropdown-link href="{{route('admin.setting.complaints.show',$complaint->id)}}">
                                            View
                                        </x-dropdown-link>
                                    @endif
                            </tr>
                        @endforeach
                    </tbody>


                </table>
            </div>
            <div class="mt-4 bg-white">
                {{ $complaints->links() }}
            </div>
        </div>
    </div>

    @include('admin.Withdrawal.modal.disapproveModal')

</x-sidebar>
@if (session('success'))
    <script>
        showAlert({{ session('success') }}, "success", 7)
    </script>
@endif
@if (session('error'))
    <script>
        showAlert("{{ session('error') }}", "danger", 5)
    </script>
@endif

@if ($errors->any())
    <script>
        showAlert("{{ $errors->first() }}", "danger", 5)
    </script>
@endif

<script>
    function showDisapproveModal() {
        document.getElementById('disapproveModal').style.display = 'block';
    }

    document.getElementById('submitDisapproval').addEventListener('click', function() {
        var reason = document.getElementById('reason').value;
        document.getElementById('disapprovalReason').value = reason;
        document.getElementById('disapprovePaymentForm').submit();
    });
    document.getElementById('cancelDisapproval').addEventListener('click', function() {
        document.getElementById('disapproveModal').style.display = 'none'
    })
</script>
