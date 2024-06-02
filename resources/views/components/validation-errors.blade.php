@if ($errors->any())
    <div {{ $attributes }}>
        {{-- <div class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}</div> --}}
<div class="bg-red-500/10 rounded-xl py-1 px-2 mt-3 border border-red-200">
        <ul class="my-3 list-none list-inside text-sm text-center mx-auto text-red-600 ">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    </div>
@endif
