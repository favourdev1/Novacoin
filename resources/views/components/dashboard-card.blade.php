<div class="">
    <div class="rounded-xl border  p-4 bg-white h-100">
        <h5 class="text-gray-600 text-sm"> {{ $title }} <a tabindex="0" class="h6 mb-0"
                role="button" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-placement="top"
                data-bs-content="{{ $info }}" data-bs-original-title=""
                title="">
                <i class="bi bi-info-circle-fill small"></i>
            </a></h5>
        <h2 class="fw-bold text-dark" style="font-size:2rem">${{ $amount }}</h2>
        {{-- <p class="mb-2 text-muted small"><span class="text-primary me-1">0.20%<i
                class="bi bi-arrow-up"></i></span>vs Yesterday</p> --}}
    </div>
</div>