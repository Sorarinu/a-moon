<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Timeline;
use App\Health;
use Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        $count = Health::where('userId', $user['email'])->count();
        $timeline = Timeline::where('userId', $user['email'])->take(10)->orderBy('created_at', 'desc')->get();

        return view('profile')->with(['timeline' => $timeline, 'count' => $count]);
    }
}
