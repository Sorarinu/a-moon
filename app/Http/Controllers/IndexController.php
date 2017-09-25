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
        $dt = Carbon::now();
        $now = $dt->format('Y-m-d');
        $d = array();
        $events = array();
        $dataset = array();
        $user = Auth::user();
        $count = 0;     // プロットの色，形を決めるためのカウンタ
        $todayDataCount = Health::where('userId', $user['email'])->where('date', $now)->count();
        $tmp_dataset = Health::where('userId', $user['email'])->orderBy('date', 'asc')->get();

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

        return view('index')->with(['data' => $d, 'dataset' => $dataset, 'events' => $events, 'count' => $todayDataCount]);
    }

    public function change(Request $request)
    {
        $d = array();
        $dataset = array();
        $user = Auth::user();
        $dt = Carbon::now();
        $now = $dt->format('Y-m-d');
        $count = 0;
        $todayDataCount = Health::where('userId', $user['email'])->where('date', $now)->count();

        if (isset($request->range)) {
            $dt = Carbon::now();
            $now = $dt->format('Y-m-d');

            switch ($request->range) {
                case 'week':
                    $rangeDt = $dt->subDay(7);
                    $range = $rangeDt->format('Y-m-d');
                    $tmp_dataset = Health::where('userId', $user['email'])->whereBetween('date', [$range, $now])->orderBy('date', 'asc')->get();
                    break;

                case 'month':
                    $rangeDt = $dt->subMonth();
                    $range = $rangeDt->format('Y-m-d');
                    $tmp_dataset = Health::where('userId', $user['email'])->whereBetween('date', [$range, $now])->orderBy('date', 'asc')->get();
                    break;

                case 'all':
                    $tmp_dataset = Health::where('userId', $user['email'])->orderBy('date', 'asc')->get();
                    break;

                default:
                    break;
            }
        } else {
            $start = $request->start;
            $end = $request->end;
            $tmp_dataset = Health::where('userId', $user['email'])->whereBetween('date', [$start, $end])->orderBy('date', 'asc')->get();
        }

        foreach ($tmp_dataset as $data) {
            $data = json_decode($data, true);

            // 心と体の症状の数をカウント
            foreach ($data as $key => $value) {
                if ($key === 'heart' || $key === 'body') {
                    $tmp = explode(',', $value);

                    if ($tmp[0] !== '') {
                        $count += count($tmp);
                    }
                    Log::debug($count);
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

            $d[] = [
                'y' => $data['date'],
                'temperature' => $data['temperature']
            ];
        }

        return view('index')->with(['data' => $d, 'dataset' => $dataset, 'count' => $todayDataCount]);
    }
}
