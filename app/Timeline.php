<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    protected $table = 'timeline';

    protected $fillable = ['userId', 'type', 'title', 'message'];
}
