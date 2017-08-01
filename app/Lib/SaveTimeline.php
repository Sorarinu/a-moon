<?php

namespace App\Lib;

use App\Timeline;

class SaveTimeline
{
    public static function save($userId, $type, $title = '', $message = '')
    {
        try {
            $timeline = new Timeline();
            $timeline->userId = $userId;
            $timeline->type = $type;
            $timeline->title = $title;
            $timeline->message = $message;
            $timeline->save();
        } catch (\Exception $e) {
            Log::debug($e);
        }
    }
}
