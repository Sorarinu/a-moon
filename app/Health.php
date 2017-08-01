<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Health extends Model
{
    protected $table = 'data';

    protected $fillable = ['date', 'temperature', 'menstruation', 'amount_bleeding', 'pain', 'medicine', 'discharge', 'amount_discharge', 'color', 'behavior', 'bleeding', 'body', 'heart'];
}
