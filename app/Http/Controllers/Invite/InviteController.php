<?php

namespace App\Http\Controllers\Invite;

use App\Models\Reunion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\History;
use DB;
use Carbon\carbon;

class InviteController extends Controller
{
    public function showInviteReunion(){

        $user_id = Auth::user()->id;

        $action ="Voir les reunion";
        $hitory = new History();
        $hitory->user_id = $user_id;
        $hitory->action = $action;
        $hitory->save();

        $datas = Reunion::all();
        return view('Invite.show_invite_reunion',compact('datas'));
    }
    public function download($file){
        return response()->download(public_path('uploads/documents/'.$file));
    }
}
