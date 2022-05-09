<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MissedMeetingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $quote;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $quotes = collect([
            "I’m going to pick up chicks by telling them I can’t read.",
            "I love her five ever... because forever just isn't enough!",
            "Bro, the best part about being drunk is there's two of her.",
            "I can't let my gf get in the way of finding my wife.",
            "What's the best way to pick up chicks at the club?",
            "Why!? What's wrong with living at your ex's parents house?",
            "When you eat a gummy bear, do you eat the head or the feet first?",
            "I'm pretty sure NASA makes up everything about space in order to convince us the earth is round.",
            "I really like your tattoos!",
        ]);

        $this->quote = $quotes->random();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@simranhatesmeetings.com', 'Simran Hates Meetings')
            ->subject('Missed Meeting Notification')
            ->markdown('mail.missed-meeting');
    }
}
