<?php

namespace App\Http\Controllers;
use App\Models\Entreprise;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    public function ListEntrepise()
    {
        $entreprises=Entreprise::latest()->get();
        return view('Admin.entreprise.liste',compact('entreprises'));
    }

    public function getUpdate(Request $request,$id)
    {
     $entreprises=Entreprise::find($id);
     return view('Admin.entreprise.modifier',compact('entreprises'));
    }

    public function EditEntreprise(Request $request)
    {

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

    public function DeleteEntreprise(Request $request)
    {
        $id=$request['id'];
        $entreprises=Entreprise::find($id);
        $entreprises->delete();
        $entreprises=Entreprise::all();
        return redirect()->route('ListEntrepise',compact('entreprises'));
     }

     public function getAddEntreprise()
    {

      return view('Admin.entreprise.ajouter');
    }
    public function AddEntreprise(Request $request)
    {

     $this->validate($request, [
       'nom' => 'alpha|nullable|max:255',
       'directeur' => 'string|nullable|max:100000',
       'adresse' => 'string|nullable|max:100000',
       'email' => 'email|nullable|max:255',

       'telephone' => 'integer|nullable|min:8',
       ]);

       $entreprises = new Entreprise();
     $entreprises->nom=$request['nom'];
     $entreprises->directeur=$request['directeur'];
     $entreprises->email=$request['email'];
     $entreprises->adresse=$request['adresse'];
     $entreprises->telephone=$request['telephone'];
    $entreprises->save();
    return redirect()->route('ListEntrepise',compact('entreprises'));

    }
}
