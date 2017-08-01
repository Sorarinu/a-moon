<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Health;
use Auth;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $dataset = Health::all();
        $user = Auth::user();
        $count = Health::where('userId', $user['email'])->count();

        return view('admin.data')->with(['dataset' => $dataset, 'count' => $count]);
    }
}
