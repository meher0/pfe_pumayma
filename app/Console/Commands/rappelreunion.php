<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\Mail\rappelmail;
use App\Models\Reunion;
use App\Models\User;
use Carbon\Carbon;
use DB;




class rappelreunion extends Command
{

    protected $signature = 'command:rappel_reunion';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {

        $datas = Reunion::all();

        foreach ($datas as $data) {
            $carbonDate = Carbon::parse($data->planifier->start);

            $now        = Carbon::now();
            $rappel     = $carbonDate->diffInDays($now);
            $emails[]   =  DB::table('users')->pluck('email');

            foreach ($emails as $email) {
                if ($rappel = 1) {
                    Mail::to($email)->send(new rappelmail());
                }
                else{
                    return 'no send mail';
                }
            }
        }
        }
}
