<x-mail::message>

<div>
    <x-logo-component/>
</div>

# Withdrawal Request 

Dear {{ $withdrawal->user->firstname." ".$withdrawal->user->lastname }},

You have requested a withdrawal of $<strong>{{ $withdrawal->amount }}</strong> from your wallet.

Unfortunately, your withdrawal request has been disapproved for the following reason:

<strong>{{ $reason }}</strong>

Here are the details of the withdrawal:
- Amount: $<strong>{{ $withdrawal->amount }}</strong>
- Withdrawal Address: <strong>{{ strtoupper($withdrawal->wallet_address) }}</strong>

If you believe this is a mistake, please contact us immediately.

Thank you for using our service!

Best Regards,

{{ config('app.name') }}
</x-mail::message>