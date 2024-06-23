<?php

namespace App\Mail;
use App\Models\Withdrawal;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WithdrawalApprovedEmail extends Mailable
{
    use Queueable, SerializesModels;

  
    public $withdrawal;
  
    /**
     * Create a new message instance.
     */
    public function __construct(Withdrawal $withdrawal)
    {
     
        $this->withdrawal = $withdrawal;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.withdrawal.withdrawal_approved')
            ->with([
             
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
