<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KalingaEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $messageContent;

    public function __construct(public string $subjectLine, string $messageContent)
    {
        $this->messageContent = $messageContent;
    }

    public function build()
    {
        return $this->subject($this->subjectLine)
            ->view('emails.kalinga');
    }
}

