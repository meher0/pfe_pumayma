<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\History;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Mail;
use App\Mail\Sendmail;

class UserController extends Controller
{
    public function showAccount()
    {
        $users= User::where('role','<>','admin')
        ->latest()->get();
        return view('Admin.compte.liste',compact('users'));
    }


    public function handleAddAccount(Request $request){


        $user_id = Auth::user()->id;

        $action ="Voir les reunion";
        $hitory = new History();
        $hitory->user_id = $user_id;
        $hitory->action = $action;
        $hitory->save();
        $action ="Ajouter un compte";
        $hitory = new History();
        $hitory->user_id = $user_id;
        $hitory->action = $action;
        $hitory->save();

        $users =  new User();
        $email = $request->email;

        $search = User::where('email','=',$email)->get();
        if ($search->count()) {
            return back()->with('alert_red','this account has been exist');
        }else{
        $users->name      = $request->name;
        $users->email     = $request->email;
        $users->role      = $request->role;
        $users->phone     = $request->phone;
        $users->password  = Hash::make($request->password);

        $users->save();

        return back()->with('alert_green','account created with success');
        }
     }



    public function showEditAccount(Request $request,$id)
    {
     $users= User::find($id);
     return view('Admin.compte.modifier',compact('users'));
    }


    public function AcceptUser(Request $request)
    {

      $id = $request->id;
      $email = $request->email;
      $name = $request->name;

      $data = User::find($id);

       $etat = 0 ;
       $data->etat = $etat;


       $data->save();

       Mail::to($email)->send(new Sendmail($name));
       return back()->with('status','account has been accepted ');

    }


    public function handleUpdateAccount(Request $request)
    {
     $this->validate($request, [
       'name' => 'alpha|nullable|max:255',
       'email' => 'email|nullable|max:255',
       'role',
       ]);
        $id=$request['id'];
        $users= User::find($id);
        $users->name=$request['name'];

        $users->email=$request['email'];
        $users->role=$request['role'];
        $users->update();

        $user_id = Auth::user()->id;
        $action ="faire un modification de compte";
        $hitory = new History();
        $hitory->user_id = $user_id;
        $hitory->action = $action;
        $hitory->save();
    return redirect()->route('list',compact('users'));
    }

    public function handleDeleteAccount(Request $request,$id)
    {


        $user_id = Auth::user()->id;
        $action ="faire un supprission de compte";
        $hitory = new History();
        $hitory->user_id = $user_id;
        $hitory->action = $action;
        $hitory->save();

        $users = User::find($id);
        $users->delete();
        return back()->with('alert_green','account deleted with success');
     }
}
