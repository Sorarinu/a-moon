<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Health;
use App\Timeline;
use App\Lib\SaveTimeline;
use App\Jobs\SendEmail;
use Auth;
use Mail;
use Log;
use Queue;

class MessageController extends Controller
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
        $messages = Timeline::where('userId', $user['email'])->get();

        return view('admin.message')->with(['messages' => $messages, 'count' => $count]);;
    }

    public function send(Request $request)
    {
        $users = User::all();
        $user = Auth::user();
        $count = Health::where('userId', $user['email'])->count();
        $subject = $request->subject;
        $body = $request->body;

        $data = ['body' => $body];

        foreach ($users as $user) {
            Queue::push(new SendEmail($data, $user['email'], $subject, $body));
            SaveTimeline::save($user['email'], 'envelope', $subject, $body);
        }

        return view('admin.message')->with(['status' => 1, 'count' => $count]);
    }

    public function remove()
    {
        $user = Auth::user();
        $count = Health::where('userId', $user['email'])->count();
        $messages = Timeline::where('userId', $user['email'])->get();

        return view('admin.message')->with(['messages' => $messages, 'count' => $count]);;
    }
}
