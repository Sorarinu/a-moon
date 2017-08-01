<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Health;
use Auth;
use Carbon\Carbon;
use Log;
use App\Timeline;
use App\Lib\SaveTimeline;

class ViewDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $count = Health::where('userId', $user['email'])->count();
        $dataset = Health::where('userId', $user['email'])->orderBy('date', 'desc')->get(); 

        return view('viewdata')->with(['dataset' => $dataset, 'count' => $count]);
    }

    public function edit(Request $request)
    {
        $user = Auth::user();
        $count = Health::where('userId', $user['email'])->count();

        if (isset($request->body)) {
            $body = implode(',', $request->body);
        } else {
            $body = '';
        }

        if (isset($request->heart)) {
            $heart = implode(',', $request->heart);
        } else {
            $heart = '';
        }

        try {
            $health = Health::find($request->id);
            $health->userId = $request->userId;
            $health->date = $request->date;
            $health->temperature = $request->temperature;
            $health->menstruation = $request->menstruation;
            $health->amount_bleeding = $request->amount_bleeding;
            $health->pain = $request->pain;
            $health->medicine = $request->medicine;
            $health->discharge = $request->discharge;
            $health->amount_discharge = $request->amount_discharge;
            $health->color = $request->color;
            $health->behavior = $request->behavior;
            $health->bleeding = $request->bleeding;
            $health->body = $body;
            $health->heart = $heart;
            $health->save();
        } catch (\Exception $e) {
            Log::debug($e);
        }

        SaveTimeline::save($request->userId, 'user', 'データを修正しました');

        $dataset = Health::where('userId', $user['email'])->orderBy('date', 'desc')->get(); 

        return view('viewdata')->with(['dataset' => $dataset, 'count' => $count]);
    }
}
