<x-mail::message>

<div >
    <x-logo-component/>
  </div>
  

# Withdrawal Request 

Dear {{ $withdrawal->user->firstname." ".$withdrawal->user->lastname }},

You have requested a withdrawal of $<strong>{{ $withdrawal->amount }}</strong> from your wallet.

We are processing your request and will transfer the funds to the following address: <strong>{{ strtoupper($withdrawal->wallet_address) }}</strong>

Here are the details of the withdrawal:
- Amount: $<strong>{{ $withdrawal->amount }}</strong>
- Withdrawal Address: <strong>{{ strtoupper($withdrawal->wallet_address) }}</strong>


Otherwise, please click the button below to confirm your withdrawal:

<x-mail::button url="{{ url('dashboard/confirm/withdraw/' . $withdrawal_token->token) }}">
Confirm Withdrawal
</x-mail::button>

<p>

    If you did not make this request, please contact us immediately.
</p>

Thank you for using our service!

Best Regards,

{{ config('app.name') }}
</x-mail::message>