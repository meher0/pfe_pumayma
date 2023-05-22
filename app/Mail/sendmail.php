<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendmail extends Mailable
{
    use Queueable, SerializesModels;

   public $name;
    public function __construct($name)
    {
        $this->name = $name;
    }


    public function build()
    {
        return $this->subject('Accepter compte')->view('mailing.accept_compte');
    }
}
