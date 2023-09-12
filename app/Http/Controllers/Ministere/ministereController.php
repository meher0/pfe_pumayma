<?php

namespace App\Http\Controllers\Ministere;

use App\Http\Controllers\Controller;
use App\Models\comment;
use App\Models\History;
use App\Models\ProcesVerbal;
use App\Models\Reunion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class ministereController extends Controller
{
    public function index(){
        $monthNames = [
            1 => 'Janvier',
            2 => 'Février',
            3 => 'Mars',
            4 => 'Avril',
            5 => 'Mai',
            6 => 'Juin',
            7 => 'Juillet',
            8 => 'Août',
            9 => 'Septembre',
            10 => 'Octobre',
            11 => 'Novembre',
            12 => 'Décembre',
        ];

        $meetingsByMonth = DB::table('reunions')
            ->select(DB::raw('MONTH(start_date) as month'), DB::raw('COUNT(*) as count'))
            ->groupBy(DB::raw('MONTH(start_date)'))
            ->get()
            ->map(function ($item) use ($monthNames) {
                $item->month = $monthNames[$item->month];
                return $item;
            });

        // Créez un tableau avec tous les mois et initialisez les réunions à zéro
    
            // Triez le tableau par mois
            $meetingsByMonth = collect($meetingsByMonth);

        return view('ministre.index', compact('meetingsByMonth'));

    }

    public function showMinistereReunion(){

        $user_id = Auth::user()->id;

        $action ="ministere voir les reunion";
        $hitory = new History();
        $hitory->user_id = $user_id;
        $hitory->action = $action;
        $hitory->save();

        $datas = Reunion::all();
        return view('Ministre.show_invite_reunion',compact('datas'));
    }


    public function download($file){
        return response()->download(public_path('uploads/documents/'.$file));
    }

    public function showMinisterePv(){
        $userId = Auth::user()->id;
        $user = User::find($userId);
        $reunions = $user->invites()->with('pv')->get();

        return view('Ministre.proces_verbal', compact('reunions'));
    }

    public function handleMinistereAddComment(Request $request)
    {
        $reunionId  = $request->input('reunion_id');
        $userId     = $request->input('user_id');
        $comment    = $request->input('comment');

        $newComment = new Comment();
        $newComment->reunion_id = $reunionId;
        $newComment->user_id    = $userId;
        $newComment->comment    = $comment;
        $newComment->save();
        return back()->with('alert_green','commentaire');
    }

    public function showMinisterePvDetailled ($id){
        $data = ProcesVerbal::find($id);

        return view('Ministre.proces_verbal_detailled',compact('data'));
    }
}
