<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
   use Queueable, SerializesModels;

   public $data;
   /**
    * Create a new data instance.
    *
    * @return void
    */

   public function __construct()
   {
   }

   /**
    * Build the message.
    *
    * @return $this
    */
   public function build()
   {
       return $this->from('phamtranthuan2003@gmail.com')
           ->view('mails.mail-notify')
           ->subject('Notification email');
   }
}
