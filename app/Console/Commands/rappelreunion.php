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
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:rappel_reunion';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $datas = Reunion::all();
            foreach ($datas as $data) {
                $carbonDate = Carbon::parse($data->start);
                $now        = Carbon::now();
                $rappel     = $carbonDate->diffInMinutes($now) / 60;
                $emails[]   =  DB::table('users')->pluck('email');
                foreach ($emails as $email) {   
                    if ($rappel > 1) {
                        Mail::to($email)->send(new rappelmail());
                    }
                    else{
                        return 'no send mail';
                    }
                
                    
                }

            }
            
            
        }
}
