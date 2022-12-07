<?php

namespace App\Jobs;

use App\Mail\CurrencyMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $users , $data;
    public function __construct($users , $data)
    {
        $this->users = $users;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->users as $user) {
            try {
                echo "sending to : ". $user->email.PHP_EOL;
                // needs correct config to send email with smtp service
                Mail::to($user->email)->send(new CurrencyMail([
                    'user' => $user,
                    'currency' => $this->data
                ]));
            } catch (\Exception $e) {
                echo "failed to send email".PHP_EOL;
//                Log::info('email : '.$e->getMessage().PHP_EOL);
            }
        }
    }
}
