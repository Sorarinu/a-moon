<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Health;
use Log;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users= User::all();
        $user = Auth::user();
        $count = Health::where('userId', $user['email'])->count();

        return view('admin.user')->with(['users' => $users, 'count' => $count]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $users= User::all();
        $user = Auth::user();
        $count = Health::where('userId', $user['email'])->count();

        foreach ($users as $user) {
            $authority = $request->input('authority-' . $user['id']);
            $userData = User::find($user['id']);
            $userData->authority = $authority;
            $userData->save();
        }

        $users= User::all();

        return view('admin.user')->with(['users' => $users, 'status' => 'ok', 'count' => $count]);
    }
}
