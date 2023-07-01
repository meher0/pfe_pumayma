<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\History;
use DB;

class HistoryController extends Controller
{
    public function showHistory()
    {
        $histories = DB::table('histories')
                ->join('users', 'users.id', '=', 'histories.user_id')
                ->select('users.*','histories.*')
                ->orderBy('histories.created_at', 'desc')
                ->get();
        return view('Admin.historique.historique',compact('histories'));
    }
}
