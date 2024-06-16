<?php
namespace App\Mail;

use App\Models\withdrawal_token;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Withdrawal;

class WithdrawalCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $withdrawal;
    public $withdrawal_token;
    public function __construct(Withdrawal $withdrawal, withdrawal_token $withdrawal_token)
    {
        $this->withdrawal = $withdrawal;
        $this->withdrawal_token = $withdrawal_token;

    }

    public function build()
    {
        return $this->markdown('emails.withdrawal.created')
            ->with('withdrawal', $this->withdrawal)
            ->with('withdrawal_token', $this->withdrawal_token);
    }
}