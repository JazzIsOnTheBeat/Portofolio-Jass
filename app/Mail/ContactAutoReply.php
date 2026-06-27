<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactAutoReply extends Mailable {
    use Queueable, SerializesModels;
    public $contact;
    public function __construct($contact) {
        $this->contact = $contact;
    }
    public function build() {
        return $this->subject('Thank you for contacting me!')
                    ->view('emails.contact-auto-reply');
    }
}
