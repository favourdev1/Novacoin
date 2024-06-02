
<div class="">
    <div class="rounded-xl border  p-4 bg-blue-600 h-100">
        <div class="flex items-center justify-between">
            <h5 class=" text-sm text-slate-50"> {{$title}}<a tabindex="0" class="h6 mb-0" role="button"
                    data-bs-toggle="popover" data-bs-trigger="focus" data-bs-placement="top"
                    data-bs-content="After US royalty withholding tax" data-bs-original-title=""
                    title="">
                    <i class="bi bi-info-circle-fill small"></i>
                </a></h5>

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

                                <a href="#" class="">Fund
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

        <h2 class="fw-bold text-white font-bold" style="font-size:2rem">{{$amount}}
        </h2>
        {{-- <p class="mb-2 text-muted small"><span class="text-primary me-1">0.20%<i
                class="bi bi-arrow-up"></i></span>vs Yesterday</p> --}}
    </div>
</div>