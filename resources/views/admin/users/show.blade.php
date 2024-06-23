<x-sidebar>

    <div class="flex items-center justify-center md:pt-10 pt-32 ">


        <div class=" flex-col flex md:flex-row justify-center  h-screen w-full">
            <div class=" w-full md:w-1/5  rounded-lg  p-6 ">
                <div class="flex justify-center">
                    <div class="mt-2" x-show="! photoPreview">
                        <img src="https://ui-avatars.com/api/?name=&color=7F9CF5&background=EBF4FF" alt="Profile name "
                            class="rounded-full h-20 w-20 object-cover">
                    </div>
                </div>
                <div class="text-center mt-6 text-sm">
                    <h2 class="text-base font-semibold ">{{ $user->firstname }} {{ $user->lastname }}</h2>
                    <p class="mt-0 text-sm {{ $user->role ? 'text-green-700' : 'text-gray-700' }} font-bold">
                        {{ $user->role ? 'Admin' : 'User' }}
                    </p>
                </div>
                <div class="">
                    <div class="flex justify-center space-x-4 text-sm mb-4 text-gray-600">
                        <div class="flex items-center space-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.05 4.05a7 7 0 019.9 0l.3.3c.39.39.39 1.02 0 1.41l-1.13 1.13a1 1 0 01-1.42 0l-.3-.3a5 5 0 00-7.07 0l-.3.3a1 1 0 01-1.42 0L4.76 5.76a1 1 0 010-1.41l.3-.3zM5.76 6.17l1.07-1.07a3 3 0 014.24 0l1.07 1.07a3 3 0 010 4.24l-1.07 1.07a1 1 0 01-1.42 0l-1.07-1.07a1 1 0 00-1.42 0l-1.07 1.07a1 1 0 01-1.42 0L4.34 10.4a1 1 0 010-1.42L5.76 6.17zm2.83 3.42a1 1 0 00-1.42 0L6.34 11.4a1 1 0 010 1.42l.3.3a5 5 0 007.07 0l.3-.3a1 1 0 010-1.42L12.4 9.59a1 1 0 00-1.42 0l-1.07 1.07a3 3 0 01-4.24 0L5.76 9.59a1 1 0 010-1.42l1.07-1.07a1 1 0 011.42 0L10.4 9.59a1 1 0 001.42 0l1.07-1.07a1 1 0 000-1.42L10.4 5.76a1 1 0 00-1.42 0l-1.07 1.07a1 1 0 000 1.42L8.59 8.59a1 1 0 01-1.42 0L6.34 7.52a1 1 0 010-1.42L7.41 5.03a3 3 0 014.24 0l1.07 1.07a3 3 0 010 4.24l-1.07 1.07a5 5 0 01-7.07 0l-.3-.3a1 1 0 00-1.42 0l-1.07 1.07a5 5 0 007.07 0l1.07-1.07a5 5 0 00-7.07 0l-1.07 1.07a5 5 0 007.07 0l.3-.3a1 1 0 000-1.42L11.17 9.59a3 3 0 010-4.24L12.24 4.34a3 3 0 010 4.24l-1.07 1.07a3 3 0 01-4.24 0l-1.07-1.07a3 3 0 010-4.24l1.07-1.07a3 3 0 014.24 0l1.07 1.07a3 3 0 010 4.24l-1.07 1.07a5 5 0 00-7.07 0l-.3.3a5 5 0 007.07 0l1.07-1.07a5 5 0 00-7.07 0L7.41 7.76a5 5 0 000 7.07l1.07-1.07a5 5 0 000-7.07L7.41 4.76a5 5 0 00-7.07 0l-.3.3a1 1 0 010 1.42l1.07 1.07a1 1 0 001.42 0L6.34 7.52a1 1 0 011.42 0L9.41 6.41a1 1 0 001.42 0L11.41 4.34a1 1 0 00-1.42 0l-1.07 1.07a1 1 0 01-1.42 0L6.34 5.03a1 1 0 00-1.42 0l-1.07 1.07a1 1 0 000 1.42l.3.3a1 1 0 000-1.42L4.34 7.52a1 1 0 000 1.42L5.76 9.59a1 1 0 011.42 0L7.41 8.59a1 1 0 000 1.42L8.59 7.52a1 1 0 00-1.42 0L6.34 8.59a1 1 0 000 1.42L5.76 9.59a1 1 0 001.42 0l1.07-1.07a3 3 0 010 4.24l-1.07 1.07a3 3 0 010 4.24L5.76 6.17z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>{{ count($investmentPlan) }} Investments </span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l.775 2.382c.07.216.267.37.495.37h2.51c.969 0 1.371 1.24.588 1.81l-2.032 1.51c-.185.138-.264.383-.192.608l.775 2.382c.3.921-.755 1.688-1.538 1.118l-2.032-1.51c-.185-.138-.43-.138-.615 0l-2.032 1.51c-.783.57-1.838-.197-1.538-1.118l.775-2.382c.072-.225-.007-.47-.192-.608l-2.032-1.51c-.783-.57-.38-1.81.588-1.81h2.51c.228 0 .425-.154.495-.37l.775-2.382z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>27 Referrals</span>
                        </div>
                    </div>
                  
                </div>
                <div class="mt-4 text-center text-sm">

                    <div class="mt-4">
                         <p class="flex items-center justify-center text-gray-400"><svg
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-1"
                                viewBox="0 0 20 20" fill="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 1 0-2.636 6.364M16.5 12V8.25" />
                            </svg>
                            {{ $user->email }}</p>
                        <p class="flex items-center justify-center text-gray-400"><svg
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-1"
                                viewBox="0 0 20 20" fill="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5-3.9 19.5m-2.1-19.5-3.9 19.5" />
                            </svg>

                            </svg> @ {{ $user->username }}</p>

                    </div>
                </div>
                <div class="flex items-center mt-3">

                    <button
                        class=" py-1.5 px-4   font-bold bg-red-700 ring-red-400 ring-1 hover:bg-red-600 text-white rounded-lg w-max mx-auto text-xs">Ban
                        User</button>
                </div>

            </div>

            <div class="flex-1 border border-[#eeeeee]  bg-[#F6F8FA] rounded-lg ">
                <div class=" pt-3 px-4 flex items-center justify-between">

                    <h4 class="font-bold  text-lg ">Profile Details </h4>
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <div class="hover:border rounded-lg  cursor-pointer hover:border-[#eeeeee] w-max">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                </svg>

                            </div>
                        </x-slot>
                        <x-slot name="content">
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                Make User Admin
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>

                </div>
                {{-- body --}}

                <div class="">
                    <div x-data="{ tab: 'tab1' }" class="w-full mb-6 md:mb-0 ">
                        <div class="w-full overflow-hidden text-sm pt-4">
                            <div class="border-b  border-[#eeeeee]">
                                <nav class="flex  flex-row gap-3 border-b px-3">
                                    <button @click="tab = 'tab1'"
                                        :class="{ 'text-blue-500 border-b-2   focus:outline-none ring-0 focus-within:outline-0 font-medium border-orange-500': tab === 'tab1' }">
                                        <span
                                            class="text-gray-600 py-1.5  mb-1.5 px-2 block hover:text-gray-500 focus:outline-none hover:bg-gray-100 rounded-lg text-nowrap text-xs md:text-sm">
                                            Investments
                                            {{-- <span class="bg-gray-300/50 rounded-full font-bold py-1 px-3"> {{$myActiveInvestmentCount}}
                                        </span> --}}
                                        </span>
                                    </button>
                                    <button @click="tab = 'tab2'"
                                        :class="{ 'text-blue-500 border-b-2   focus:outline-none ring-0 focus-within:outline-0 font-medium border-orange-500': tab === 'tab2' }"><span
                                            class="text-gray-600 py-1.5  mb-1.5 px-2 block hover:text-gray-500 focus:outline-none hover:bg-gray-100 rounded-lg text-nowrap text-xs md:text-sm">
                                            Fund Request
                                            {{-- <span class="bg-gray-300/50 rounded-full font-bold py-1 px-3">
                                                {{ $availbleInvestmentCount }}
                                            </span> --}}
                                    </button>
                                    <button @click="tab = 'tab3'"
                                        :class="{ 'text-blue-500 border-b-2   focus:outline-none ring-0 focus-within:outline-0 font-medium border-orange-500': tab === 'tab3' }"><span
                                            class="text-gray-600 py-1.5  mb-1.5 px-2 block hover:text-gray-500 focus:outline-none hover:bg-gray-100 rounded-lg text-nowrap text-xs md:text-sm">
                                            Withdrawal Requests
                                            {{-- <span class="bg-gray-300/50 rounded-full font-bold py-1 px-3"> {{$allEndedInvestmentCount}}
                                        </span> --}}
                                    </button>
                                </nav>
                            </div>


                            <div id="tab-content" class="p-2 md:p-5 lg:px-10 bg-white min-h-[80vh]">
                                <!-- Content for Tab 1 -->
                                <div x-show="tab === 'tab1'" class="tab-content active">
                                    <div class="w-1/3 py-4">
                                        <x-dashboard-card title="Today's Earnings"
                                            info="After US royalty withholding tax" amount="{{ $user->balance }}" />
                                    </div>

                                    @include('admin.users.Pages.investTable')

                                </div>
                                <!-- Content for Tab 2 -->
                                <div x-show="tab === 'tab2'" class="tab-content">
                                    <div class="w-1/3 py-4">
                                        <x-dashboard-card title="Today's Earnings"
                                            info="After US royalty withholding tax" amount="{{ $user->balance }}" />
                                    </div>
                                    @include('admin.users.Pages.fundTable')

                                </div>
                                <!-- Content for Tab 3 -->
                                <div x-show="tab === 'tab3'" class="tab-content">
                                    <div class="w-1/3 py-4">
                                        <x-dashboard-card title="Today's Earnings"
                                            info="After US royalty withholding tax" amount="{{ $user->balance }}" />
                                    </div>
                                    @include('admin.users.Pages.withdrawTable')

                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>

    </div>


</x-sidebar>
