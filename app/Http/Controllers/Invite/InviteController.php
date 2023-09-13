<?php

namespace App\Http\Controllers\Invite;

use App\Models\Reunion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\History;
use DB;
use Carbon\carbon;
use App\Models\Decision;

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

    public function handleInviteDownload($file){
        return response()->download(public_path('uploads/decision/'.$file));
    }
    public function handleInviteDownloadReunion($file){
        return response()->download(public_path('uploads/documents/'.$file));
    }

    public function showListDecision(){
        $userId = Auth::user()->id;
        $datas = Decision::where('user_id',$userId)->latest()->get();
        return view('invite.list_decision',compact('datas'));
    }
    public function handleInviteUpdateDecision(Request $request,$id){
        $data = Decision::find($id);
        $data->status = $request->status;
        $data->update();
        return back()->with('alert-green','status changed');
    }
}
