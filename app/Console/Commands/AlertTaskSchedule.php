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

class AlertTaskSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AlertTaskSchedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $dt = Carbon::now();
        $now = $dt->format('Y-m-d');

        $users = User::all();

        foreach($users as $user) {
            $data = Health::where('userId', $user['email'])->where('date', $now)->get();

            if(!isset($data[0])) {
                $subject = 'A-Moonよりお知らせ【A-Moon】';
                $body = $user['nickname'] . ' 様<br><br>本日も一日お疲れ様でした．<br>明日も忘れずに基礎体温の登録を行いましょう．<br><br>--<br>A-Moon';

                $data = ['body' => $body];

                Queue::push(new SendEmail($data, $user['email'], $subject, $body));
                SaveTimeline::save($user['email'], 'envelope', $subject, $body);
            }
        }
    }
}
