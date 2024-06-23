<x-mail::message>

<div>
    <x-logo-component/>
</div>

# Withdrawal Request 

Dear {{ $withdrawal->user->firstname." ".$withdrawal->user->lastname }},

You have requested a withdrawal of $<strong>{{ $withdrawal->amount }}</strong> from your wallet.

We are pleased to inform you that your withdrawal request has been approved.

Here are the details of the withdrawal:
- Amount: $<strong>{{ $withdrawal->amount }}</strong>
- Withdrawal Address: <strong>{{ strtoupper($withdrawal->wallet_address) }}</strong>

The funds should be available in your wallet shortly. If you encounter any issues, please contact us immediately.

Thank you for using our service!

Best Regards,

{{ config('app.name') }}
</x-mail::message>