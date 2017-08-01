<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Health;
use DB;
use Auth;
use Log;
use Carbon\Carbon;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $d = array();
        $events = array();
        $user = Auth::user();
        $count = Health::where('userId', $user['email'])->count();
        $dataset = Health::where('userId', $user['email'])->orderBy('date', 'asc')->get(); 

        return view('index')->with(['data' => $d, 'dataset' => $dataset, 'events' => $events, 'count' => $count]);
    }

    public function change(Request $request)
    {
        $start = $request->start;
        $end = $request->end;

        $d = array();
        $user = Auth::user();
        $count = Health::where('userId', $user['email'])->count();
        $dataset = Health::where('userId', $user['email'])->whereBetween('date', [$start, $end])->get(); 

        foreach ($dataset as $data) {
            $d[] = [
                'y' => $data['date'],
                'temperature' => $data['temperature']
            ];
        }

        return view('index')->with(['data' => $d, 'dataset' => $dataset, 'count' => $count]);
    }
}
