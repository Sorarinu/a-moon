<?php

namespace App\Lib;

use Mail;

class SendEmail
{
    public static function send($data, $emailaddress, $subject = '')
    {
        Mail::queue('emails.message', $data, function($message) use($emailaddress, $subject) {
            $message->to($emailaddress)->subject($subject);
        });
    }
}
