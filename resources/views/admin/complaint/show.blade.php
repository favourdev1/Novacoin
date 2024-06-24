<x-sidebar>
    <div class="container mx-auto text-sm pt-5 lg:p-6  rounded-lg ">
       

        <!-- Complaint Content -->
        <div class="bg-white p-6 rounded-lg w-full lg:w-1/2 border  border-gray-200">
             <!-- Complaint Header -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-semibold text-gray-800">Complaint Details</h2>
          
        </div>
            <!-- Complaint Number and Date -->
            <div class="mb-4">
                <span class="text-lg font-medium text-gray-700">Complaint #{{$complaint->id}}</span>
                <span class="block text-sm font-medium text-gray-500">{{$complaint->created_at}}</span>
            </div>
            
            <!-- Complaint Status -->
            <div class="mb-2
                <span class="text-sm font-medium text-gray-500">Status: </span>
                <span class="text-sm font-medium text-green-600">{{ucfirst($complaint->status)}}</span>
            </div>
            
            <!-- Complaint Description -->
            <div class="mb-4 prose">
                <h3 class="text-lg font-semibold text-gray-800">Subject: <span id="mailSubject">  {{$complaint->subject}}
                    </span></h3>
                <p class="mt-2 text-gray-600">{{$complaint->message}}</p>
            </div>
            
            <!-- User Information -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-800 text-base">User Information:</h3>
                <p class="mt-2 text-gray-600" id="email">{{$complaint->name}}</p>
                <p class="text-gray-600">{{$complaint->email}}</p>
               
            </div>

            <!-- Action Buttons -->
            <div class="flex space-x-4 mt-6">
                <button class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50" id="resolveButton">
                    Resolve
                </button>
                <form method="POST" action="{{ route('admin.setting.complaints.destroy',  $complaint->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                        Delete
                    </button>
                </form>
                
            </div>
        </div>
    </div>
</x-sidebar>

<script>
    document.getElementById('resolveButton').addEventListener('click', function() {
        // Customize the email details below
        const recipient = document.getElementById('email').innerText; // The email address to send to
        const subject = encodeURIComponent(document.getElementById('mailSubject').innerText); // The subject of the email
        const body = encodeURIComponent("Dear {{$complaint->name}},\n\n"); // The body of the email
    
        // Construct the mailto link and navigate to it
        window.location.href = `mailto:${recipient}?subject=${subject}&body=${body}`;
    });
    </script>