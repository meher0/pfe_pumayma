<?php

namespace App\Http\Controllers\Ministere;

use App\Http\Controllers\Controller;
use App\Models\comment;
use App\Models\Decision;
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

        $meetingsData = Reunion::selectRaw('MONTH(start_date) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();


        $monthsOfYear = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $meetingsByMonth = array_fill(0, 12, 0);

        foreach ($meetingsData as $data) {
            $monthIndex = $data->month - 1; // Mois commence à 1, donc soustrayez 1 pour obtenir un indice de tableau.

            if ($monthIndex >= 0 && $monthIndex < 12) {
                $meetingsByMonth[$monthIndex] = $data->count;
            }
        }


        // Récupérez les données de la base de données
        $meetingsData = Reunion::selectRaw('DAYNAME(start_date) as day_of_week, COUNT(*) as count')
            ->groupBy('day_of_week')
            ->orderByRaw('DAYOFWEEK(start_date)')
            ->get();

        // Créez un tableau pour les jours de la semaine et le nombre de réunions
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $meetingsByDay = array_fill(0, 7, 0);

        foreach ($meetingsData as $data) {
            $dayIndex = array_search($data->day_of_week, $daysOfWeek);

            if ($dayIndex !== false) {
                $meetingsByDay[$dayIndex] = $data->count;
            }
        }

        return view('ministre.index', compact('meetingsByMonth','meetingsByDay'));

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

    public function showMinisterePv(){
        $reunions = Reunion::with(['pv.comments'])->get();
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

    public function showministereDecision(){
        $datas = Decision::latest()->get();
        return view('Ministre.list_decision',compact('datas'));
    }
    public function handleMinistereDownload(Request $request,$file){
        return response()->download(public_path('uploads/decision/'.$file));
    }
    public function handleMinistereDownloadReunion(Request $request,$file){
        return response()->download(public_path('uploads/documents/'.$file));
    }
}
