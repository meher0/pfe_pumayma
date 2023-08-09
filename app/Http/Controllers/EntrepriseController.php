<?php

namespace App\Http\Controllers;
use App\Mail\rappelmail;
use App\Models\Entreprise;
use App\Models\History;
use App\Models\Reunion;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use Mail;

class EntrepriseController extends Controller
{



    public function ListEntrepise()
    {
        $entreprises=Entreprise::latest()->get();
        return view('unite.entreprise.liste',compact('entreprises'));
    }

    public function getUpdate(Request $request,$id)
    {
     $entreprises=Entreprise::find($id);
     return view('unite.entreprise.modifier',compact('entreprises'));
    }

    public function EditEntreprise(Request $request)
    {

        $user_id = Auth::user()->id;
        $action ="faire un modification de entreprise";
        $hitory = new History();
        $hitory->user_id = $user_id;
        $hitory->action = $action;
        $hitory->save();

     $this->validate($request, [
       'nom' => 'alpha|nullable|max:255',
       'directeur' => 'string|nullable|max:100000',
       'adresse' => 'string|nullable|max:100000',
       'email' => 'email|nullable|max:255',
       'telephone' => 'integer|nullable|min:8',
       ]);
     $id=$request['id'];
     $entreprises=Entreprise::find($id);
     $entreprises->nom=$request['nom'];
     $entreprises->directeur=$request['directeur'];
     $entreprises->email=$request['email'];
     $entreprises->adresse=$request['adresse'];
     $entreprises->telephone=$request['telephone'];
    $entreprises->update();
    return redirect()->route('ListEntrepise',compact('entreprises'));

    }

    public function DeleteEntreprise(Request $request,$id)
    {
        $user_id = Auth::user()->id;
        $action ="faire un supprission de entrprise";
        $hitory = new History();
        $hitory->user_id = $user_id;
        $hitory->action = $action;
        $hitory->save();
        $entreprises=Entreprise::find($id);
        $entreprises->delete();
        return back()->with('alert_red','Entrprise a été supprimer avec suceé');
     }

     public function getAddEntreprise()
    {

      return view('unite.entreprise.ajouter');
    }
    public function AddEntreprise(Request $request)
    {


        $user_id = Auth::user()->id;
        $action ="faire un ajoute de entrprise";
        $hitory = new History();
        $hitory->user_id = $user_id;
        $hitory->action = $action;
        $hitory->save();

       $entreprises = new Entreprise();
        $entreprises->nom       = $request->nom;
        $entreprises->directeur = $request->directeur;
        $entreprises->email     = $request->email;
        $entreprises->adresse   = $request->adresse;
        $entreprises->telephone = $request->telephone;
        $entreprises->save();

    return redirect()->route('ListEntrepise',compact('entreprises'))->with('alert_green','entreprise ajouter avec succeé');

    }
}
