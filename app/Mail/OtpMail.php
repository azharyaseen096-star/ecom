<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Headers;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $otp;
    public string $purpose;
    public string $userName;

    /**
     * Create a new message instance.
     */
    public function __construct(string $otp, string $purpose = 'Account Verification', string $userName = 'Valued Customer')
    {
        $this->otp = $otp;
        $this->purpose = $purpose;
        $this->userName = $userName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('mail.from.address'), config('mail.from.name', 'BazaarPK Security')),
            replyTo: [
                new Address(config('mail.from.address'), config('mail.from.name', 'BazaarPK Support'))
            ],
            subject: "[{$this->otp}] is your BazaarPK verification code",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.otp',
            text: 'emails.otp-text',
            with: [
                'otp' => $this->otp,
                'purpose' => $this->purpose,
                'userName' => $this->userName,
            ]
        );
    }

    /**
     * Get the message headers for priority delivery to Inbox.
     */
    public function headers(): Headers
    {
        return new Headers(
            text: [
                'X-Priority' => '1',
                'X-MSMail-Priority' => 'High',
                'Importance' => 'High',
                'Auto-Submitted' => 'auto-generated',
                'X-Auto-Response-Suppress' => 'OOF, AutoReply',
            ]
        );
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
