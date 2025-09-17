<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Inquiry;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InquiryReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $inquiry;

    public function __construct(Inquiry $inquiry)
    {
        $this->inquiry = $inquiry;
    }

    public function build()
    {
        return $this->from('info@jskennedy.com', 'Website Contact Form')
                    ->subject('New Inquiry Received')
                    ->view('emails.inquiry')
                    ->with(['inquiry' => $this->inquiry]);
    }
}
