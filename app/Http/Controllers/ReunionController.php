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


class ReunionController extends Controller
{
    public function PrepareReunion (){
        $planifies = Planifier::latest()->get();  
        return view('admin.reunion.prepare_reunion',compact('planifies'));
    }

    
    public function DetaikReunion ($id){
        $planifier = Planifier::find($id);
        $users = User::where('role','<>','admin')->get();
        return view('admin.reunion.detail',compact('planifier','users'));
    }

    public function AddReunion(Request  $request) {
        $time_start_reunion = $request->start;

        $time_validate = Reunion::where('start',$time_start_reunion)->get();

        if ($time_validate->count()) {
            return redirect('fetch_reunion')->with('status','ce date ne pas disponible pour fait un reunion');
           
        } else {
            $reunions = new Reunion();


            $file      = $request->file('document');
            $extension = $file->getClientOriginalExtension();
            $filename  = time() . '.' . $extension;
            $file->move('uploads/documents',$filename);
    
            $reunions->document   =$filename;
            $reunions->title = $request->title;
            $reunions->type = $request->type;
            $reunions->start = $request->start;
            $reunions->end = $request->end;
            $reunions->objectif = $request->objectif;
            $reunions->lieu = $request->lieu;
            $reunions->save();
    
            foreach($request->invites as $invite){
               
                $invites = new Invite();
                $invites->reunion_id = $reunions->id;
                $invites->user_id = $invite;
                $invites->save();     
            }
    
            return redirect('fetch_reunion')->with('status','reunion cree avec succeé');
           
        }

       

       
    }

    //*********download document******* */

    public function Download(Request $request,$document){
        return response()->download(public_path('uploads/documents/'.$document));
    }
    


    public function GetInviteReunion($id){
       
        $reunions = Reunion::find($id);
        if(!$reunions) abort(404);
        $users  = $reunions->users;
        return view('admin.reunion.view_invite',compact('users'));
    }

    


    public function DeleteReunion($id){
        $data = Reunion::find($id);
        $data->delete();
        return back()->with('status','date deleted');
    }


    public function DestroyPlanifier($id){
        $data = Planifier::find($id);
        $data->delete();
        return back()->with('status','date deleted');
    }


    public function GetReunion(){
        $datas = Reunion::all();
        return view('admin.reunion.consulter_reunion',compact('datas'));
    }

}
