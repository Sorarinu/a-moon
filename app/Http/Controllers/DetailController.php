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

class DetailController extends Controller
{
    public function index($date, Request $request)
    {
        $user = Auth::user();
        $dataset = Health::where('userId', $user['email'])->where('date', $date)->get();
        $dataset = json_decode(json_encode($dataset), true);
        Log::debug($dataset[0]);

        return view('detail')->with(['dataset' => $dataset[0]]);
    }
}
