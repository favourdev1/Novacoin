<x-sidebar>
    {{-- form --}}
    <div class="flex items-center justify-center pt-20">
        @php
            $isEdit = isset($faq);
            $formAction = $isEdit ? route('admin.setting.faq.update', $faq->id) : route('admin.setting.faq.store');
            $formMethod = $isEdit ? 'PUT' : 'POST';
            $buttonText = $isEdit ? 'Update Faq Information' : 'Create Faq Information';
            $headerText = $isEdit ? 'Edit Faq Information' : 'Create Faq Information';
        @endphp

        <form class="rounded-lg border border-[#e0e0e0] w-full md:w-2/4 xl:w-1/3 text-sm text-gray-600"
            action="{{ $formAction }}" method="POST">
            <div class="p-4 border-b">
                <h3 class="font-bold text-xl ">{{ $headerText }}</h3>
            </div>
            @csrf
            @if ($isEdit)
                @method('PUT')
            @endif

            <x-validation-errors class="mb-4 px-10" />

            <div class="p-4">
                <div class="mb-4 text-sm">
                    <label for="question" class="block text-gray-700 text-sm font-bold mb-2">Question</label>
                    <input type="text" name="question" id="question"
                        class="appearance-none border border-[#e0e0e0] rounded w-full py-1.5 text-sm px-3 text-gray-700 focus:outline-none focus:ring"
                        value="{{ old('question', $isEdit ? $faq->question : '') }}" required>
                </div>

                {{-- add id field if  --}}
                @if ($isEdit)
                    <input type="hidden" name="id" value="{{ $faq->id }}">
                @endif
                <div class="mb-4 text-sm">
                    <label for="answer" class="block text-gray-700 text-sm font-bold mb-2">Answer</label>
                    <input type="text" name="answer" id="answer"
                        class="appearance-none border border-[#e0e0e0] rounded w-full py-1.5 text-sm px-3 text-gray-700 focus:outline-none focus:ring"
                        value="{{ old('answer', $isEdit ? $faq->answer : '') }}" required>



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
