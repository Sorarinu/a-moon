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
        $d = array();
        $user = Auth::user();
        $count = Health::where('userId', $user['email'])->count();

        if (isset($request->range)) {
            $dt = Carbon::now();
            $now = $dt->format('Y-m-d');

            switch ($request->range) {
                case 'week':
                    $rangeDt = $dt->subDay(7);
                    $range = $rangeDt->format('Y-m-d');
                    $dataset = Health::where('userId', $user['email'])->whereBetween('date', [$range, $now])->orderBy('date', 'asc')->get(); 
                    break;

                case 'month':
                    $rangeDt = $dt->subMonth();
                    $range = $rangeDt->format('Y-m-d');
                    $dataset = Health::where('userId', $user['email'])->whereBetween('date', [$range, $now])->orderBy('date', 'asc')->get(); 
                    break;

                case 'all':
                    $dataset = Health::where('userId', $user['email'])->orderBy('date', 'asc')->get(); 
                    break;

                default:
                    break;
            }
        } else {
            $start = $request->start;
            $end = $request->end;
            $dataset = Health::where('userId', $user['email'])->whereBetween('date', [$start, $end])->orderBy('date', 'asc')->get(); 
        }

        foreach ($dataset as $data) {
            $d[] = [
                'y' => $data['date'],
                'temperature' => $data['temperature']
            ];
        }

        return view('index')->with(['data' => $d, 'dataset' => $dataset, 'count' => $count]);
    }
}
