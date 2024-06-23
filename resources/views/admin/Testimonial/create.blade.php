<x-sidebar>
    {{-- form --}}
    <div class="flex items-center justify-center pt-20">
        @php
            $isEdit = isset($testimonial);
            $formAction = $isEdit ? route('admin.setting.testimonial.update', $testimonial->id) : route('admin.setting.testimonial.store');
            $formMethod = $isEdit ? 'PUT' : 'POST';
            $buttonText = $isEdit ? 'Update Testimonial ' : 'Create Testimonial ';
            $headerText = $isEdit ? 'Edit Testimonial ' : 'Create Testimonial ';
        @endphp

        <form class="rounded-lg border border-[#e0e0e0] w-full md:w-2/4 xl:w-1/3 text-sm text-gray-600" enctype="multipart/form-data"
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

                    {{-- add an image fileld to be uploaded  --}}
              
                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image:</label>
                        <input type="file" name="image" id="image"
                               class="block w-full text-sm text-gray-500
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-violet-50 file:text-violet-700
                                      hover:file:bg-violet-100
                                      focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-opacity-50 border rounded-lg"
                               required>
                        @error('image')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
           

                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                    <input type="text" name="name" id="name"
                                            class="appearance-none border border-[#e0e0e0] rounded w-full py-1.5 text-sm px-3 text-gray-700 focus:outline-none focus:ring"
                                            value="{{ old('name', $isEdit ? $testimonial->name : '') }}" required>
                </div>

                {{-- add id field if  --}}
                @if($isEdit)
                    <input type="hidden" name="id" value="{{ $testimonial->id }}">
                @endif
                <div class="mb-4 text-sm">
                    <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Testimonial</label>
                    <input type="text" name="message" id="message"
                                            class="appearance-none border border-[#e0e0e0] rounded w-full py-1.5 text-sm px-3 text-gray-700 focus:outline-none focus:ring"
                                            value="{{ old('message', $isEdit ? $testimonial->message : '') }}" required>


                        
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
