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
use Carbon\Carbon;
use Illuminate\Support\Facades\Stroage;
use App\Models\History;
use Illuminate\Support\Facades\Auth;


class ReunionController extends Controller
{
    public function PrepareReunion (){
        $planifies = Planifier::latest()->get();
        return view('unite.reunion.prepare_reunion',compact('planifies'));
    }


    public function DetailReunion ($id){
        $planifier = Planifier::find($id);
        $users = User::where('role','invite')->get();
        return view('unite.reunion.detail',compact('planifier','users'));
    }

    public function AddReunion(Request  $request) {
        $time_start_reunion = $request->start;

        $time_validate = Reunion::where('start_date',$time_start_reunion)->get();

        if ($time_validate->count()) {
            return redirect('fetch_reunion')->with('status','ce date ne pas disponible pour fait un reunion');

        } else {

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
            $reunions->title = $request->title;
            $reunions->type = $request->type;
            $reunions->start_date = $request->start;
            $reunions->end_date = $request->end;
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

}
