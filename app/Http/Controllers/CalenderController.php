<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Planifier;

class CalenderController extends Controller
{
    public function index(Request $request)
    {
    	if($request->ajax())
    	{
    		$data = Planifier::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
                       ->get(['id', 'title', 'start', 'end']);
            return response()->json($data);
    	}
    	return view('home');
    }

    public function action(Request $request)
    {
    	if($request->ajax())
    	{
    		if($request->type == 'add')
    		{
    			$Planifier = Planifier::create([
    				'title'		=>	$request->title,
    				'start'		=>	$request->start,
    				'end'		=>	$request->end
    			]);

    			return response()->json($Planifier);
    		}

    		if($request->type == 'update')
    		{
    			$Planifier = Planifier::find($request->id)->update([
    				'title'		=>	$request->title,
    				'start'		=>	$request->start,
    				'end'		=>	$request->end
    			]);

    			return response()->json($Planifier);
    		}

    		if($request->type == 'delete')
    		{
    			$Planifier = Planifier::find($request->id)->delete();

    			return response()->json($Planifier);
    		}
    	}
    }
}
?>
