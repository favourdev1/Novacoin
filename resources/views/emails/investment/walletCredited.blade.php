<x-mail::message>

<div>
    <x-logo-component/>
</div>

# Wallet Credited

Dear {{ $userName }},

We are pleased to inform you that your wallet has been credited.

Here are the details of the transaction:
- Amount Credited: $<strong>{{ $amount }}</strong>

The funds should now be available in your wallet. If you encounter any issues or have any questions, please do not hesitate to contact us.

Thank you for using our service!

Best Regards,

{{ config('app.name') }}
</x-mail::message>