<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Health;
use App\User;
use App\Jobs\SendEmail;
use App\Lib\SaveTimeline;
use Log;
use Queue;

Class Notification extends Command
{
    protected $signature = 'Notification';

    protected $description = 'Daily Notification';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $dt = Carbon::now();
        $now = $dt->format('Y-m-d');

        $users = User::all();

        foreach($users as $user) {
            $data = Health::where('userId', $user['email'])->where('date', $now)->get();

            if(!isset($data[0])) {
                $subject = 'データ未登録のお知らせ【A-Moon】';
                $body = $user['nickname'] . ' 様<br><br>本日のデータが未登録となっております．<br>お忘れの場合は，登録をお願い致します．<br><br>--<br>A-Moon';

                $data = ['body' => $body];

                Queue::push(new SendEmail($data, $user['email'], $subject, $body));
                SaveTimeline::save($user['email'], 'envelope', $subject, $body);
            }
        }
    }
}
