<x-mail::message>
    # Hello, {{ $name }}

    Your account has been funded with the amount of ${{ $amount }}.
    Your new balance is ${{ $balance }}.

    Thank you for using our service!
    <x-mail::button :url="''">
        Button Text
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
