<x-sidebar>
    <div class=" py-4 bg-[#F6F8FA] flex items-center justify-center min-h-[90vh]">
        <div
            class=" py-4  bg-white rounded-lg unded-lg border border-[#eoeoeo] w-full md:w-3/5 xl:w-2/4  2xl:w-1/3 text-gray-600">
            <h3 class="p-4 font-bold text-3xl">Complaint Form</h3>

            <form action="{{route('contact.store')}}" method="POST" class="w-full p-4
        ">
                @csrf

                <div class="mb-4 w-full">
                    <label for="name" class="block text-sm text-gray-700 font-bold mb-2">Your Name:</label>
                    <input type="text" name="name" id="name"
                        class="appearance-none text-sm border-gray-200 rounded w-full py-1.5 px-3 text-gray-700 focus:outline-none focus:ring"
                        value="{{ Auth::check() ? Auth::user()->firstname . ' ' . Auth::user()->lastname : '' }}"
                        {{ Auth::check() ? 'disabled' : '' }} required>
                    @if (Auth::check())
                        <small class="text-gray-400">Autofilled based on your account information </small>
                    @endif
                </div>

                <div class="mb-4 w-full">
                    <label for="email" class="block text-sm text-gray-700 font-bold mb-2">Your Email:</label>
                    <input type="email" name="email" id="email"
                        class="appearance-none text-sm border-gray-200 rounded w-full py-1.5 px-3 text-gray-700 focus:outline-none focus:ring"
                        value="{{ Auth::check() ? Auth::user()->email : '' }}" {{ Auth::check() ? 'disabled' : '' }}
                        required>
                    @if (Auth::check())
                        <small class="text-gray-400">Autofilled based on your account information </small>
                    @endif
                </div>

                <div class="mb-4 w-full">
                    <label for="email" class="block text-sm text-gray-700  font-bold mb-2">Ticket Title?</label>
                    <input type="email" name="email" id="email"
                        class="appearance-none text-sm border-gray-200  rounded w-full py-1.5  px-3 text-gray-700 focus:outline-none focus:ring"
                        required>
                </div>

                <div class="mb-4 w-full">
                    <label for="complaint" class="block text-sm text-gray-700  font-bold mb-2">What is your complaint
                        about?</label>
                    <textarea name="complaint" id="complaint"
                        class="appearance-none text-sm border-gray-200  rounded w-full py-1.5  px-3 text-gray-700 focus:outline-none focus:ring"
                        rows="5" required></textarea>
                </div>

                <div class="flex items-center justify-center pb-2">

                    <small class="text-gray-400 text-center w-full ">Our representative would respond to you
                        back via email </small>
                </div>


                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3  px-4 rounded-full focus:outline-none focus:ring w-full text-sm">Submit
                    Complaint</button>
            </form>

        </div>
    </div>
</x-sidebar>
