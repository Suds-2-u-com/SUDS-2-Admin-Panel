<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtraMinHoursModel extends Model
{
    protected $table = 'extra_min_hours';

    protected $fillable = ['min_hours','extra_time','price'];
}
