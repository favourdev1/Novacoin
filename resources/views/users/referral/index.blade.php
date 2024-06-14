<x-sidebar>



    <div class="flex w-full py-4">
        <div class="rounded-xl border  p-4 bg-blue-600 h-100 lg:w-2/4 mx-auto">
            <div class="flex items-center justify-between">
                <h5 class=" text-lg text-slate-50">Referral Earnings</h5>


                <div>

                    <x-dropdown align="right" width="w-max">
                        <x-slot name="trigger">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-5 h-5 text-white font-bold">
                                <path fill-rule="evenodd"
                                    d="M10.5 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Zm0 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Zm0 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z"
                                    clip-rule="evenodd" />
                            </svg>

                        </x-slot>

                        <x-slot name="content">

                            <!-- Account Management -->
                            <div class="block px-2 py-2 text-xs text-gray-600">

                                <p class="hover:bg-gray-200 rounded px-2 py-1.5">

                                    <a href="{{ route('fundAccount.index') }}" class="">Fund
                                        Account</a>
                                </p>
                                <p class="hover:bg-gray-200 rounded px-2 py-1.5">

                                    <a href="#" class=" ">Withdraw Funds </a>
                                </p>


                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <h2 class="fw-bold text-white font-bold" style="font-size:2rem">{{ 0 }}
            </h2>

        </div>
    </div>

    <div  class="w-full">

        
        <div class=" flex w-full ">
            <div class="flex flex-col items-center justify-center gap-2 lg:w-2/4 mx-auto ">
                <div class="text-center">
                    <h4 class="font-bold ">Referral Link</h4>
                    <div class="border rounded-xl px-4 py-2  flex items-center gap-3 bg-gray-50 text-sm">
                        <p class=" whitespace-nowrap flex-1 overflow-hidden text-gray-700" id="referralUrl">
                            @php
                                $appUrl = url('/register');
                                $token = Auth::user()->referral_code;
                                $url = $appUrl . '?ref=' . $token;
                            @endphp
        
                            {{ $url }}
                        </p>
                        {{-- copy icon --}}
                        <div class="col hover:bg-gray-300 group-hover:bg-gray-800 duration-400 p-2 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4 cursor-pointer "
                                data-tippy-content="Copy referral link" id="copyIcon">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" />
                            </svg>
        
                        </div>
                    </div>
                </div>
                <div class="mx-auto w-full">
                    <h4 class="font-bold text-lg w-full">My Downliners </h4>
                </div>
                <div class="overflow-x-auto mx-auto w-full">
                    <table class="min-w-full w-full bg-white">
                        <thead class="bg-gray-200 text-gray-600  text-sm leading-normal">
                            <tr>
                                <th class="py-3 px-6 text-left">#</th>
                                <th class="py-3 px-6 text-left">Username</th>
                                <th class="py-3 px-6 text-left">Firstname</th>

                                <th class="py-3 px-6 text-left">Lastname</th>
                                <th class="py-3 px-6 text-left">Joined</th>

                             
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($referral as $users)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        {{ $i++ }}
                                    </td>
                                    <td class="py-3 px-6 text-left whitespace-nowrap">{{ $users->username }}</td>
                                    <td class="py-3 px-6 text-left">{{ $users->firstname }}</td>

                                    <td class="py-3 px-6 text-left">{{ $users->lastname }}</td>
                                 
                                    <td class="py-3 px-6 text-left">
                                       {{$users->created_at}}
                                    </td>
                                   
                                </tr>
                            @endforeach
                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>

</x-sidebar>


<script>
    document.getElementById('copyIcon').addEventListener('click', function() {
        var copyText = document.getElementById("referralUrl").innerText;
        navigator.clipboard.writeText(copyText).then(function() {
            alert('Copied to clipboard');
        }).catch(function() {
            alert('Failed to copy text');
        });
    });
</script>
