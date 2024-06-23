<x-sidebar>
    {{-- form --}}
    <div class="flex items-center justify-center pt-20">
        @php
            $isEdit = isset($withdrawalCurrency);
            $formAction = $isEdit ? route('admin.setting.withdrawalcurrencies.update', $withdrawalCurrency->id) : route('admin.setting.withdrawalcurrencies.store');
            $formMethod = $isEdit ? 'PUT' : 'POST';
            $buttonText = $isEdit ? 'Update Withdrawal Currency' : 'Create Withdrawal Currency';
            $headerText = $isEdit ? 'Edit Withdrawal Currency' : 'Create Withdrawal Currency';
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
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Currency Name</label>
                    <input type="text" name="name" id="name"
                        class="appearance-none border border-[#e0e0e0] rounded w-full py-1.5 text-sm px-3 text-gray-700 focus:outline-none focus:ring"
                        value="{{ $isEdit ? $withdrawalCurrency->name : '' }}" placeholder="eg Bitcoin" required>
                </div>
                {{-- conditionally add id  --}}
                @if($isEdit)
                    <input type="hidden" name="id" value="{{ $withdrawalCurrency->id }}">
                @endif


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
@if (session('success'))
    <script>
       showAlert( {{ session('success') }},"success")
    </script>
@endif
@if (session('error'))
    <script>
       showAlert( "{{ session('error') }}", "danger")
    </script>
@endif