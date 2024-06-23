<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Withdrawal;

class WithdrawalDisapprovedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $withdrawal;
    public $disapproveReason;
    /**
     * Create a new message instance.
     */
    public function __construct(Withdrawal $withdrawal, $disapproveReason)
    {
        $this->disapproveReason = $disapproveReason;
        $this->withdrawal = $withdrawal;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.withdrawal.withdrawal_disapproved')
            ->with([
                'reason'=>$this->disapproveReason,
                'withdrawalAmount' => $this->withdrawal->amount,
                'withdrawalCurrency' => $this->withdrawal->wallet->wallet_name,
            ]);
    }
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}