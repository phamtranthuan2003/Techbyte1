<?php


namespace App\Jobs;

use App\Mail\MailNotify;
use Illuminate\Bus\Queueable;
use Illuminate\Container\Attributes\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmail
{
    use Dispatchable, InteractsWithQueue, SerializesModels;
    protected $data;
    
    protected $users;

    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to('phamtranthuan2003@gmail.com')->send(new MailNotify($this->data));
    }
}
