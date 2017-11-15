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

class ViewUserGraphController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $userId = $request->userId;
        Log::debug($userId);
        $dt = Carbon::now();
        $now = $dt->format('Y-m-d');
        $events = array();
        $dataset = array();
        $user = Auth::user();
        $count = 0;     // プロットの色，形を決めるためのカウンタ
        $tmp_dataset = Health::where('userId', $userId)->orderBy('date', 'asc')->get();

        foreach ($tmp_dataset as $data) {
            $data = json_decode($data, true);

            // 心と体の症状の数をカウント
            foreach ($data as $key => $value) {
                if ($key === 'heart' || $key === 'body') {
                    $tmp = explode(',', $value);

                    if ($tmp[0] !== '') {
                        $count += count($tmp);
                    }
                }
            }

            if ($data['menstruation'] === 'あり') {
                if ($count === 0) {
                    $plot = 'w_redstar.png';
                } else {
                    $plot = 'redstar.png';
                }
            } else if ($data['menstruation'] === 'なし') {
                if ($count === 0) {
                    $plot = 'w_dotpoint.png';
                } else {
                    $plot = 'dotpoint.png';
                }
            }

            $data['plot'] = $plot;
            $dataset[] = $data;
            $count = 0;
        }

        return view('viewUserGraph')->with(['dataset' => $dataset, 'events' => $events, 'userId' => $userId]);
    }
}
