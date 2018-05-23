<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Vinkla\Hashids\Facades\Hashids;

class VerifyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user,$url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $token = Hashids::encode([$this->user->id,time()]);
        $this->url = url('verify-email/'.$token);
        return $this->subject('Verify Email Address')->markdown('emails.verify-email');
    }
}
