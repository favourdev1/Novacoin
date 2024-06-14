<x-mail::message>
# Introduction

# Withdrawal Request Created

Dear ,

You have requested a withdrawal of from your  wallet.

We are processing your request and will transfer the funds to the following address: {{ $withdrawal->wallet_address }}.

<div style="background-color: #ebf8ff; padding: 1em; border-radius:8px; font-size:12px">
    This is some text in a section with a blue background and blue border.
</div>

Thank you for using our service!

Best Regards,

{{ config('app.name') }}
</x-mail::message>