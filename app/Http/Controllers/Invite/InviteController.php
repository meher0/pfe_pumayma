<?php

namespace App\Http\Controllers\Invite;

use App\Models\Reunion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\carbon;

class InviteController extends Controller
{
    public function GetReunionInvite(){
        $datas = Reunion::all();
        return view('invite.voir_reunion',compact('datas'));
    }

    public function Download(Request $request,$document){
        return response()->download(public_path('uploads/documents/'.$document));
    }
}
