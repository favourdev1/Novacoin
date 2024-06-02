<x-sidebar>
    {{-- form --}}
    <div class="flex items-center justify-center pt-20">
        @php
            $isEdit = isset($investmentPlan);
            $formAction = $isEdit ? route('investmentPlan.update', $investmentPlan->id) : route('investmentPlan.store');
            $formMethod = $isEdit ? 'PUT' : 'POST';
            $buttonText = $isEdit ? 'Update Investment Plan' : 'Create Investment Plan';
            $headerText = $isEdit ? 'Edit Investment Plan' : 'Create Investment Plan';
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
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Investment Name</label>
                    <input type="text" name="name" id="name"
                        class="appearance-none border border-[#e0e0e0] rounded w-full py-1.5 text-sm px-3 text-gray-700 focus:outline-none focus:ring"
                        value="{{ $isEdit ? $investmentPlan->name : '' }}" required>
                </div>

                <div class="mb-4 text-sm">
                    <label for="min_amount" class="block text-gray-700 text-sm font-bold mb-2">Min Investment Amount</label>
                    <input type="number" name="min_amount" id="min_amount"
                        class="appearance-none border border-[#e0e0e0] rounded w-full py-1.5 text-sm px-3 text-gray-700 focus:outline-none focus:ring"
                        value="{{ $isEdit ? $investmentPlan->min_amount : '' }}" required>
                </div>

                <div class="mb-4 text-sm">
                    <label for="max_amount" class="block text-gray-700 text-sm font-bold mb-2">Max Investment Amount</label>
                    <input type="number" name="max_amount" id="max_amount"
                        class="appearance-none border border-[#e0e0e0] rounded w-full py-1.5 text-sm px-3 text-gray-700 focus:outline-none focus:ring"
                        value="{{ $isEdit ? $investmentPlan->max_amount : '' }}" required>
                </div>

                <div class="mb-4 text-sm">
                    <label for="duration" class="block text-gray-700 text-sm font-bold mb-2">Duration (days)</label>
                    <input type="number" name="duration" id="duration"
                        class="appearance-none border border-[#e0e0e0] rounded w-full py-1.5 text-sm px-3 text-gray-700 focus:outline-none focus:ring"
                        value="{{ $isEdit ? $investmentPlan->duration : '' }}" required>
                </div>

                <div class="mb-4 text-sm">
                    <label for="daily_interest" class="block text-gray-700 text-sm font-bold mb-2">Daily Interest (%)</label>
                    <input type="number" name="daily_interest" id="daily_interest"
                        class="appearance-none border border-[#e0e0e0] rounded w-full py-1.5 text-sm px-3 text-gray-700 focus:outline-none focus:ring"
                        value="{{ $isEdit ? $investmentPlan->daily_interest : '' }}" required>
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
