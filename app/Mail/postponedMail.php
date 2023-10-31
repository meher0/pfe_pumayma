<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class postponedMail extends Mailable
{
    use Queueable, SerializesModels;


    public $title,$address,$date;
    public function __construct($title,$address,$date)
    {
        $this->title   = $title;
        $this->address = $address;
        $this->date    = $date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Réportation')->view('mailing.reporter');
    }
}
