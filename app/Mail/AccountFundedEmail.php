<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AccountFundedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $amount;


    /**
     * Create a new message instance.
     */
    public function __construct($user, $amount)
    {
        $this->user = $user;
        $this->amount = $amount;
    }
 

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Account Funded Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build(){
    // {
    //     return new Content(
    //         markdown: 'emails.account_fundedEmail',
    //     );

        return $this->markdown('emails.account_fundedEmail')
        ->with([
            'name' => $this->user->name,
            'amount' => $this->amount,
            'balance' => $this->user->balance,
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
