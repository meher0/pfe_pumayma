<?php

namespace App\Http\Controllers;

use App\Models\Reunion;
use App\Models\Decision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class DecisionController extends Controller
{
    public function showReunionFinished(){
        $datas = Reunion::where('end_date', '<', now())->get();
        return view('unite.decision.show_reunion_finish',compact('datas'));
    }
    public function showUniteDecision(){
        $datas = Decision::latest()->get();
        return view('unite.decision.list_decision',compact('datas'));
    }

    public function handleAddDecision(Request $request)
    {

        // Validate the form data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'date_fin_decision' => 'required|date',
            'file' => 'required|file|mimes:pdf,docx|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Store the file
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' .$extension;
        $file->move('uploads/decision', $filename);
        $reunionId = $request->reunion_id;
        // Create a new decision record
        $decision = new Decision();
        $decision->reunion_id = $reunionId;
        $decision->title = $request->input('title');
        $decision->date_end_decision = $request->input('date_fin_decision');
        $decision->file = $filename;
        $decision->user_id = $request->invite;
        $decision->save();

        // Redirect back with a success message
        return redirect('unite/decision/list')->with('alert_green', 'Decision added successfully');
    }

    public function handleDownloadDecision(Request $request,$file){
        return response()->download(public_path('uploads/decision/'.$file));
    }

    public function handleUniteDeleteDecision($id){
        $data = Decision::find($id)->delete();
        return back()->with('alert_red','Décision a éte supprimer avec succée');
    }
}
