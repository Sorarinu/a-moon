<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Log;
use App\Health;
use App\Timeline;
use App\Lib\SaveTimeline;
use Carbon\Carbon;
use Auth;
use Intervention\Image\Facades\Image;

class RegistController extends Controller
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

        return view('regist')->with(['count' => $count]);
    }

    public function regist(Request $request)
    {
        $this->validate($request, [
            'temperature' => 'required|numeric'
        ]);

        $user = Auth::user();
        $count = Health::where('userId', $user['email'])->count(); 

        $dataCount = Health::where('userId', $request->userId)->where('date', $request->registDay)->count();
        Log::debug($dataCount);

        if ($dataCount > 0) {
            return view('regist')->with(['status' => 'error']);
        }

        $dt = Carbon::now();

        if ($request->registDay === $dt->format('Y-m-d')) {
            $day = $dt->format('Y-m-d');
        } else {
            $day = $dt->subDay()->format('Y-m-d');
        }
        Log::debug('Registday is ' . $day);

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
            if (isset($request->fileName)) {
                $fileName = time() . '_' . $request->fileName->getClientOriginalName();
                $image = Image::make($request->fileName->getRealPath());
                $image->resize(200, null, function($constraint) {
                    $constraint->aspectRatio();
                });
                $image->save(public_path() . '/upImages/' . $fileName);
                $path = 'upImages' . $fileName;
            } else {
                $fileName = '';
            }

            $health = new Health();
            $health->userId = $request->userId;
            $health->date = $day;
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
            $health->imagePath = $fileName != '' ? 'upImages/' . $fileName : '';
            $health->save();
        } catch (\Exception $e) {
            Log::debug($e);
        }

        SaveTimeline::save($request->userId, 'user', 'データを登録しました');

        return view('regist')->with(['status' => 'regist', 'count' => $count]);
    }
}
