<x-sidebar>
    <div class="lg:px-10 py-4">
        <div class="pb-4">


            <div class="flex items-center justify-between text-gray-700 pt-3">

                <h3 class="font-semibold text-2xl pb-4">{{ $greetings }}</h3>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-2">

                <div class="">
                    <div class="rounded-xl border  p-4 bg-white h-100 flex items-center">
                        <div class="flex-1">

                            <h5 class="text-gray-600 text-sm"> Total Users<a tabindex="0" class="h6 mb-0" role="button"
                                    data-bs-toggle="popover" data-bs-trigger="focus" data-bs-placement="top"
                                    data-bs-content="After US royalty withholding tax" data-bs-original-title=""
                                    title="fskdlnfklsnfs">

                                </a></h5>
                            <h2 class="fw-bold text-dark" style="font-size:2rem">{{ $users->count() }}</h2>
                            <p class="mb-2 text-muted small">
                        </div>

                        <img src="{{ asset('assets/images/peopleIcon.png') }}" alt='arrow-up' class=''>
                    </div>
                </div>

                {{-- user investment card --}}
                <div class="">
                    <div class="rounded-xl border  p-4 bg-white h-100 flex items-center">
                        <div class="flex-1">

                            <h5 class="text-gray-600 text-sm"> Users Invested<a tabindex="0" class="h6 mb-0"
                                    role="button" data-bs-toggle="popover" data-bs-trigger="focus"
                                    data-bs-placement="top" data-bs-content="After US royalty withholding tax"
                                    data-bs-original-title="" title="fskdlnfklsnfs">

                                </a></h5>
                            <h2 class="fw-bold text-dark" style="font-size:2rem">{{ $investmentPlan->count() }}</h2>
                            <p class="mb-2 text-muted small">
                        </div>

                        <img src="{{ asset('assets/images/analyticsIcon.png') }}" alt='arrow-up' class=''>
                    </div>
                </div>

                {{-- fund acoung card --}}
                <div class="">
                    <div class="rounded-xl border  p-4 bg-white h-100 flex items-center">
                        <div class="flex-1">

                            <h5 class="text-gray-600 text-sm">Funds<a tabindex="0" class="h6 mb-0" role="button"
                                    data-bs-toggle="popover" data-bs-trigger="focus" data-bs-placement="top"
                                    data-bs-content="After US royalty withholding tax" data-bs-original-title=""
                                    title="fskdlnfklsnfs">

                                </a></h5>
                            <h2 class="fw-bold text-dark" style="font-size:2rem">${{ $funds }}</h2>
                            <p class="mb-2 text-muted small">
                        </div>

                        <img src="{{ asset('assets/images/Icon (2).png') }}" alt='arrow-up' class=''>
                    </div>
                </div>

                {{--  --}}
                <div class="">
                    <div class="rounded-xl border  p-4 bg-white h-100 flex items-center">
                        <div class="flex-1">

                            <h5 class="text-gray-600 text-sm"> Investment Packages<a tabindex="0" class="h6 mb-0"
                                    role="button" data-bs-toggle="popover" data-bs-trigger="focus"
                                    data-bs-placement="top" data-bs-content="After US royalty withholding tax"
                                    data-bs-original-title="" title="fskdlnfklsnfs">

                                </a></h5>
                            <h2 class="fw-bold text-dark" style="font-size:2rem">{{ $allInvestmentPlans->count() }}</h2>
                            <p class="mb-2 text-muted small">
                        </div>

                        <img src="{{ asset('assets/images/analyticsIcon.png') }}" alt='arrow-up' class=''>
                    </div>
                </div>
            </div>

        </div>



        {{-- section  --}}

        <div class="md:flex md:flex-row items-start gap-4 w-full">
            {{-- active Iinvestments  --}}
            <div class="border rounded-xl flex-1 h-full bg-white">
                <div class="p-4 ">
                    <h3 class="font-semibold ">Funding</h3>
                </div>

                @if ($AllFundings->count() == 0)
                    <div class="p-4 min-h-96 w-full">
                        <div class="flex justify-between items-center w-full h-full">
                            <div class="flex items-center w-full h-full ">
                                {{-- no active inestment --}}
                                <div class="rounded-xl border py-2 px-4 bg-gray-100 w-max mx-auto text-center text-sm">
                             No user has funded their account

                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="overflow-x-auto p-3 w-full">
                        <table class="min-w-full bg-white" >
                            <thead class="bg-gray-200 text-gray-600  text-sm leading-normal">
                                <tr>
                                    <th class="py-3 px-6 text-left text-sm whitespace-nowrap ">#</th>
                                    <th class="py-3 px-6 text-left text-sm whitespace-nowrap ">Username</th>
                                    <th class="py-3 px-6 text-left text-sm whitespace-nowrap ">Crypto </th>

                                    <th class="py-3 px-6 text-left text-sm whitespace-nowrap ">Amount</th>
                                    <th class="py-3 px-6 text-left text-sm whitespace-nowrap "> Proof</th>

                                    <th class="py-3 px-6 text-left text-sm whitespace-nowrap ">Status</th>
                                    <th class="py-3 px-6 text-left text-sm whitespace-nowrap ">Approval Status</th>
                                    <th class="py-3 px-6 text-left text-sm whitespace-nowrap ">Date</th>
                                    <th class="py-3 px-6 text-left text-sm whitespace-nowrap ">Action</th>

                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($AllFundings as $funding)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-left text-sm whitespace-nowrap  ">
                                            {{ $i++ }}
                                        </td>
                                        <td class="py-3 px-6 text-left text-sm whitespace-nowrap  ">{{ $funding->username }}
                                        </td>
                                        <td class="py-3 px-6 text-left text-sm whitespace-nowrap ">{{ $funding->wallet_name }}</td>

                                        <td class="py-3 px-6 text-left text-sm whitespace-nowrap ">${{ $funding->amount }}</td>
                                        <td class="py-3 px-6 text-left text-sm whitespace-nowrap "><a
                                                href="{{ asset('storage/payment_proofs/' . $funding->payment_proof) }}"><img
                                                    class="w-5 h-5"
                                                    src="{{ asset('storage/payment_proofs/' . $funding->payment_proof) }}" /></a>
                                        </td>
                                        <td class="py-3 px-6 text-left text-sm whitespace-nowrap ">
                                            <span
                                                class="{{ $funding->status == 'approved' ? 'bg-green-200 text-green-600' : 'bg-gray-200 text-grey-600' }} py-1 px-3 rounded-full text-xs">
                                                {{ $funding->status }}
                                            </span>
                                        </td>

                                        <td class="py-3 px-6 text-left text-sm whitespace-nowrap ">
                                            {{ $funding->approved_by == null ? 'not appproved' : 'approved' }}</td>
                                        <td class="py-3 px-6 text-left text-sm whitespace-nowrap ">{{ $funding->created_at }}</td>

                                        <td class="py-3 px-6 text-left text-sm whitespace-nowrap  flex items-center gap-2">
                                            @if ($funding->status == 'approved' || $funding->status == 'disapproved')
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    {{ $funding->status }}
                                                </div>
                                            @else
                                                <x-dropdown align="right" width="48">
                                                    <x-slot name="trigger">
                                                        <button
                                                            class="flex items-center text-sm font-medium text-gray-500 bg-white border border-transparent rounded-md px-3 py-2 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                            
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                                              </svg>
                                                              
                                                        </button>
                                                    </x-slot>

                                                    <x-slot name="content">

                                                        <form action="{{ route('admin.approvePayment') }}"
                                                            method="POST"
                                                            class="block px-4 py-2 text-sm text-gray-700">
                                                            @csrf
                                                            <input type="hidden" name="id"
                                                                value="{{ $funding->fund_accountId }}">
                                                            @method('POST')
                                                            <button type="submit" class="w-full text-left">Approve
                                                                Payment</button>
                                                        </form>

                                                        <form action="{{ route('admin.disapprovePayment') }}"
                                                            method="POST"
                                                            class="block px-4 py-2 text-sm text-gray-700">
                                                            @csrf
                                                            <input type="hidden" name="id"
                                                                value="{{ $funding->fund_accountId }}">
                                                            @method('POST')
                                                            <button type="submit" class="w-full text-left">Disapprove
                                                                Payment</button>
                                                        </form>
                                                    </x-slot>
                                                </x-dropdown>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>


                        </table>
                    </div>
                    <div class="mt-4 bg-white">
                        {{ $AllFundings->links() }}
                    </div>
                @endif
            </div>





            {{-- side section --}}
            <div class="borders rounded-xl w-1/5 p-3 flex justify-center flex-col gap-2">
                {{-- <p class="font-bold text-lg">Refer and earn</p>
                <p class="text-sm text-gray-500">Use the link below to invite your friends </p>
                <div class="border rounded-xl px-4 py-2  flex items-center gap-3 bg-gray-50 text-sm">
                    <p class=" whitespace-nowrap flex-1 overflow-hidden text-gray-700">
                        https://app.convests.com/register/zoxilygydu
                    </p> --}}
                    {{-- copy icon --}}
                    {{-- <div class="col hover:bg-gray-300 group-hover:bg-gray-800 duration-400 p-2 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 cursor-pointer">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" />
                        </svg>

                    </div> --}}
                </div>
            </div>
        </div>
    </div>


</x-sidebar>
{{--  --}}
