<?php

namespace App\Console\Commands;

use App\Jobs\SendMail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class SendCurrencyData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    public function handle()
    {
        $amount = 350000;
        $response = Http::accept('application/json')->get('http://csi.parsijoo.ir');
        // http://csi.parsijoo.ir uri has responded with 502 status code.

        DB::table('users')->orderBy('id')->chunk(200,function ($users) use ($amount){
            SendMail::dispatch($users , $amount);
        });
    }
}
