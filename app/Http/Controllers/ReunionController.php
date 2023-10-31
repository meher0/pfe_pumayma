<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reunion;
use App\Models\Planifier;
use App\Models\User;
use App\Models\Invite;
use DB;
use Mail;
use App\Mail\rappelmail;
use App\Mail\cancelMail;
use App\Mail\postponedMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Stroage;
use App\Models\History;
use Illuminate\Support\Facades\Auth;


class ReunionController extends Controller
{
    public function PrepareReunion (){
        $planifies = Planifier::where('status',null)->latest()->get();
        return view('unite.reunion.prepare_reunion',compact('planifies'));
    }

    public function showUniteFile ($id){
        $data = Reunion::find($id);

        return view('unite.reunion.file',compact('data'));
    }



    public function DetailReunion ($id){
        $planifier = Planifier::find($id);
        $users = User::where('role','invite')->get();
        return view('unite.reunion.detail',compact('planifier','users'));
    }

    public function AddReunion(Request  $request) {
        $planifierId =$request->planifier_id;

            $data = Planifier::find($planifierId);

            $data->status = 1;
            $data->save();

            $user_id = Auth::user()->id;
            $action ="faire un ajouter de reunion";
            $hitory = new History();
            $hitory->user_id = $user_id;
            $hitory->action = $action;
            $hitory->save();
            $reunions = new Reunion();


            $file      = $request->file('document');
            $extension = $file->getClientOriginalExtension();
            $filename  = time() . '.' . $extension;
            $file->move('uploads/documents',$filename);

            $reunions->document   =$filename;
            $reunions->planifier_id = $planifierId;
            $reunions->title = $request->title;
            $reunions->type = $request->type;
            $reunions->objectif = $request->objectif;
            $reunions->lieu = $request->lieu;
            $reunions->save();

            foreach($request->invites as $invite){

                $invites = new Invite();
                $invites->reunion_id = $reunions->id;
                $invites->user_id = $invite;
                $invites->save();
            }

            return redirect('voir_reunion')->with('alert_green','reunion cree avec succeé');

        }






    //*********download document******* */

    public function Download(Request $request,$id){
        return response()->download(public_path('uploads/documents/'.$id));
    }

    public function GetInviteReunion($id){
        $reunions = Reunion::find($id);
        if(!$reunions) abort(404);
        $users  = $reunions->users;
        return view('unite.reunion.view_invite',compact('users'));
    }

    public function DeleteReunion($id){

        $user_id = Auth::user()->id;
        $action ="faire un supprission de reunion";
        $hitory = new History();
        $hitory->user_id = $user_id;
        $hitory->action = $action;
        $hitory->save();

        $data = Reunion::find($id);
        $users = $data->users;
        foreach ($users as $user) {
            // Send an email to each user
            Mail::to($user->email)->send(new cancelMail($data->title)); // Replace YourEmailView with the actual email view you want to send.
        }
        $data->delete();
        return back()->with('alert_red','date deleted');
    }


    public function DestroyPlanifier($id){
        $data = Planifier::find($id);
        $data->delete();
        return back()->with('status','date deleted');
    }


    public function GetReunion(){
        $datas = Reunion::all();
        return view('unite.reunion.consulter_reunion',compact('datas'));
    }


    public function showReunionFinish($id){
        $data = Reunion::find($id);
        return view('unite.reunion.form_pv',compact('data'));
    }


    public function handleReporterReunion(Request $request,$id){
        $data = Planifier::find($request->planifier_id);
        $data->start = $request->start;
        $data->end   = $request->end;

        $reunionFind = Reunion::find($id);
        $users = $reunionFind->users;
        foreach ($users as $user) {
            Mail::to($user->email)->send(new postponedMail($reunionFind->title,$reunionFind->lieu,$request->start));
        }


        $data->update();
        return back()->with('alert_green','réunion a été reporter');
    }

}
