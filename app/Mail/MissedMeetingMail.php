<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;

class MissedMeetingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $quote;

    public function __construct()
    {
        $this->quote = collect([
            'I’m going to pick up chicks by telling them I can’t read.',
            "I love her five ever... because forever just isn't enough!",
            "Bro, the best part about being drunk is there's two of her.",
            "I can't let my gf get in the way of finding my wife.",
            "What's the best way to pick up chicks at the club?",
            "Why!? What's wrong with living at your ex's parents house?",
            'When you eat a gummy bear, do you eat the head or the feet first?',
            "I'm pretty sure NASA makes up everything about space in order to convince us the earth is round.",
            'I really like your tattoos!',
        ])->random();
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('noreply@simranhatesmeetings.com', 'Simran Hates Meetings'),
            subject: 'Missed Meeting Notification',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.missed-meeting',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
