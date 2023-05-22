<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Mail;
use App\Mail\Sendmail;

class UserController extends Controller
{
    public function ListUser()
    {
        $users= User::where('role','<>','admin')
        ->where('etat',0)->latest()->get();
        return view('Admin.compte.liste',compact('users'));
    }


    public function NewUser()
    {
        $users= User::where('role','<>','admin')->where('etat',1)->latest()->get();


        return view('Admin.compte.newliste',compact('users'));
    }

    public function getUpdate(Request $request,$id)
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


    public function EditUser(Request $request)
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
    return redirect()->route('ListUser',compact('users'));

    }

    public function DeleteUser(Request $request)
    {
        $id=$request['id'];
        $users=\App\Models\User::find($id);
        $users->delete();
        $users=\App\Models\User::all();
        return redirect()->route('ListUser',compact('users'));
     }

     public function getAddUser()
    {

      return view('Admin.compte.ajouter');
    }
    public function AddUser(Request $request)
    {

     $this->validate($request, [
       'name' => 'alpha|nullable|max:255',

       'email' => 'email|nullable|max:255',
       'role' => 'alpha|nullable|max:255',

       ]);

       $users = new \App\Models\User();
     $users->name=$request['name'];

     $users->email=$request['email'];
     $users->role=$request['role'];
    $users->save();
    return redirect()->route('ListUser',compact('users'));

    }
}
