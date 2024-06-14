@component('mail::layout')@component('mail::message')
{{-- Add the app icon --}}
{{-- Add the app icon --}}
<div style="width:40px; height:40px">
    <img src="{{ asset('path/to/logo.png') }}" alt="App Logo">
</div>


# Investment Successful

Hello,

Congratulations! Your investment has been successfully processed. We appreciate your contribution and trust in our company.

Here are the details of your investment:
- Amount: ${{ $investmentAmount }}
- Investment ID: {{ $investmentId }}
- Investment Plan: {{ $investmentPlan }}
- Expected Return: {{ $expectedReturn }}

Please note that the expected return is an estimate and actual returns may vary. We will keep you updated on the progress of your investment.

If you have any questions or need further assistance, please feel free to contact us.

Thank you for investing with us,
The NovaCoin Team
@endcomponent