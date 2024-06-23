<x-sidebar>
    {{-- form --}}
    <div class="flex items-center justify-center pt-20">
        @php
            $isEdit = isset($wallet);
            $formAction = $isEdit ? route('admin.setting.wallet.update', $wallet->id) : route('admin.setting.wallet.store');
            $formMethod = $isEdit ? 'PUT' : 'POST';
            $buttonText = $isEdit ? 'Update wallet Information' : 'Create wallet Information';
            $headerText = $isEdit ? 'Edit wallet Information' : 'Create wallet Information';
        @endphp

        <form class="rounded-lg border border-[#e0e0e0] w-full md:w-2/4 xl:w-1/3 text-sm text-gray-600"
            action="{{ $formAction }}" method="POST">
            <div class="p-4 border-b">
                <h3 class="font-bold text-xl ">{{ $headerText }}</h3>
            </div>
            @csrf
            @if($isEdit)
                @method('PUT')
            @endif

            <x-validation-errors class="mb-4 px-10" />

            <div class="p-4">
                <div class="mb-4 text-sm">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Wallet Name</label>
                    <input type="text" name="wallet_name" id="name"
                                            class="appearance-none border border-[#e0e0e0] rounded w-full py-1.5 text-sm px-3 text-gray-700 focus:outline-none focus:ring"
                                            value="{{ old('wallet_name', $isEdit ? $wallet->wallet_name : '') }}" required>
                </div>

                {{-- add id field if  --}}
                @if($isEdit)
                    <input type="hidden" name="id" value="{{ $wallet->id }}">
                @endif
                <div class="mb-4 text-sm">
                    <label for="wallet_address" class="block text-gray-700 text-sm font-bold mb-2">Wallet Address</label>
                    <input type="text" name="wallet_address" id="wallet_address"
                                            class="appearance-none border border-[#e0e0e0] rounded w-full py-1.5 text-sm px-3 text-gray-700 focus:outline-none focus:ring"
                                            value="{{ old('wallet_address', $isEdit ? $wallet->wallet_address : '') }}" required>


                        
                </div>

                

            </div>

            <div class="p-4 border-t flex items-center">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 text-sm px-4 rounded-full focus:outline-none focus:ring w-full">
                    {{ $buttonText }}
                </button>
            </div>
        </form>
    </div>
</x-sidebar>
