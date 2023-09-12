<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProcesVerbal;
use App\Models\User;
use App\Models\Comment;

use Illuminate\Support\Facades\Auth;

class PvController extends Controller
{
    public function HandleAddProcesVerbal(Request $request, $id){
        $procesVerbal =  new ProcesVerbal();
        $procesVerbal->reunion_id = $id;
        $file = $request->file('document');
            $extension = $file->getClientOriginalExtension();
            $filename  = time() . '.' . $extension;
            $file->move('pv/uploads',$filename);
            $procesVerbal->document = $filename;
        $procesVerbal->save();
        return back()->with('alert_green','pv a ete ajout avec succeéé');
    }

    public function showInvitePv(){
      $userId = Auth::user()->id;
      $user = User::find($userId);
      $reunions = $user->invites()->with('pv')->get();

      return view('Invite.proces_verbal', compact('reunions'));
    }

    public function handleAddComment(Request $request)
    {
        $pvId  = $request->input('proces_verbal_id');
        $userId     = $request->input('user_id');
        $comment    = $request->input('comment');

        $newComment = new Comment();
        $newComment->proces_verbal_id = $pvId;
        $newComment->user_id    = $userId;
        $newComment->comment    = $comment;
        $newComment->save();
        return back()->with('alert_green','commentaire');
    }

    public function showInvitePvDetailled ($id){
        $data = ProcesVerbal::find($id);

        return view('Invite.proces_verbal_detailled',compact('data'));
    }
}
