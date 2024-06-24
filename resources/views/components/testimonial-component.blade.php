<div class="bg-gray-50 text-gray-800 rounded-2xl max-w-32 md:max-w-96 min-w-96 p-6 border border-[#dfdede] mb-6">
    <p class="mb-4 text-base">
        {{ $review }}
    </p>
    <div class="flex items-center">
        <img src="{{ $avatar }}" alt="User Avatar" class="w-10 h-10 rounded-full mr-4">
        <div>
            <h3 class="font-semibold text-xs">{{ $name }}</h3>

        </div>
    </div>
</div>


<style>
    .marquee-content {
        
        animation: marquee 40s linear infinite;
    }

    @keyframes marquee {
        0% {
            transform: translateX(0%);
        }

        100% {
            transform: translateX(-100%);
        }
    }
</style>
