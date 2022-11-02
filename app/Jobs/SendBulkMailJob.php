<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\CreateMail;
use Illuminate\Support\Facades\Mail;



class SendBulkMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $data;
    public $recipient;
    public function __construct($data,$recipient)
    {
        $this->data=$data;
        $this->recipient=$recipient;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {      
         Mail::to($this->recipient)->send(new CreateMail($this->data));            
    }
}
