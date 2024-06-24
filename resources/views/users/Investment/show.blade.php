<x-sidebar>
    {{-- form --}}
    <div class="flex items-center justify-center pt-20">

        <div class="rounded-lg border border-[#e0e0e0] bg-white w-full md:w-2/4 xl:w-1/3 text-sm text-gray-600 ">
            <div class="py-4 border-b flex items-center">
                <a href="{{ url()->previous() }}"
                    class=" text-white font-bold py-2 pl-4 cursor-pointer rounded-full focus:outline-none focus:ring-0 mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 text-gray-800">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m18.75 4.5-7.5 7.5 7.5 7.5m-6-15L5.25 12l7.5 7.5" />
                    </svg>

                </a>
                <h3 class="font-bold text-xl ">Investment Details</h3>
            </div>

            {{-- content --}}
            <div class="grid grid-cols-2 items-center gap-3 mt-3 p-4">
                <div class=" bg-gray-50 rounded-xl min-h-max border border-[#eee] p-4">
                    <p class="text-lg font-bold py-0 my-0">${{$userInvestment->amount}}</p>
                    <p class="text-xs py-0 my-0 whitespace-nowrap">Amount Invested</p>
                </div>
    
                {{-- duration --}}
                <div class=" bg-gray-50 rounded-xl min-h-max border border-[#eee] p-4">
                    <p class="text-lg font-bold py-0 my-0 whitespace-nowrap">{{$userInvestment->duration}} days</p>
                    <p class="text-xs py-0 my-0 whitespace-nowrap">Duration</p>
                </div>
    
                {{-- percentage income --}}
                <div class=" bg-gray-50 rounded-xl min-h-max border border-[#eee] p-4">
                    <p class="text-lg font-bold py-0 my-0 whitespace-nowrap">{{intval($userInvestment->daily_interest)}} %</p>
                    <p class="text-xs py-0 my-0 whitespace-nowrap">Daily Interest</p>
                </div>
                <div class=" bg-gray-50 rounded-xl min-h-max border border-[#eee] p-4">
                    <p class="text-lg font-bold py-0 my-0">$</p>
                    <p class="text-xs py-0 my-0 whitespace-nowrap">Amount Invested</p>
                </div>
    
                
            </div>
            <p class="text-sm font-bold text-gray-500 py-0 my-0 px-4 mt-3 uppercase">Extra Information</p>
            <div class="grid grid-cols-1 items-center gap-3  p-4">
               

                @php
                // Assuming $date is the created_at date string from your database
                // and $investmentDuration is the duration in days as an integer
                $endDate = \Carbon\Carbon::parse($userInvestment->created_at)->addDays((int)$userInvestment->duration);
            
                $currentDate = \Carbon\Carbon::now();
                $daysLeft = intval($currentDate->diffInDays($endDate, false));
            @endphp
            
            
                <div class=" bg-gray-50 rounded-xl min-h-max border border-[#eee] p-4">
                    <p class="text-sm font-bold py-0 my-0">  Ending 
                        @if ($daysLeft == 0)
                            Today
                        @elseif ($daysLeft == 1)
                           in 1 day
                        @else
                          in  {{ $daysLeft }} days
                        @endif</p>
                    <p class="text-xs py-0 my-0 whitespace-nowrap">End Date</p>
                </div>
    
                {{-- duration --}}
                <div class=" bg-gray-50 rounded-xl min-h-max border border-[#eee] p-4">
                    <p class="text-sm font-bold py-0 my-0">Principal + Interest paid at maturity</p>
                    <p class="text-xs py-0 my-0 whitespace-nowrap">Payout Type</p>
                </div>
    
             
    
            </div>
        </div>
    </div>
</x-sidebar>
